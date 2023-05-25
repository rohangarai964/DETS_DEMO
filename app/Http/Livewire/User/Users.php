<?php

namespace App\Http\Livewire\User;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Throwable;


class Users extends Component
{
    public $user_id;
    public $isOpen = 0;
    public $name;
    public $email;
    public $password;
    public $role;
    public $passwordConfirmation;
   
    use WithPagination;
  
    public function mount(){

}
    public function render()
    {
        $perPage = 5;

        $collection = User::all();

        $Users = $collection->forPage($this->page, $perPage);

        $paginator = new LengthAwarePaginator($Users, $collection->count(), $perPage, $this->page);
        return view('livewire.user.user',[
            'users'=>$paginator
        ]);
    }
   

public function edit($id)
{
   

    $Users = User::findOrFail($id);
    $this->user_id = $id;
    $this->name=$Users->name;
    $this->email = $Users->email;
    $this->password=$Users->password;
    $this->role=$Users->role;
    $this->passwordConfirmation =$Users->password;
   
    $this->openModal();
}
public function openModal()
{
    $this->isOpen = true;
}


public function closeModal()
{
    $this->isOpen = false;
}
public function store()
{
    $cred=session()->get('login_data');
    $this->validate([
        'email' => 'required|unique:users,email,'.$this->user_id,
        'name'=> 'required',
        'password' => 'required|min:6|same:passwordConfirmation',
        'role'=>'required|numeric'
       
    ]);
    if($this->user_id>0){
        $data = array(
            'name' => $this->name,
            'email' => $this->email,
            'role' =>$this->role,
           
        );  
    }else{
    $data = array(
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'role'=>$this->role
       
    );
}
    $Users = User::updateOrCreate(['id' => $this->user_id],$data);
    $this->dispatchBrowserEvent('notify', 'User updated Successfull');
    $this->closeModal();
    $this->resetInputFields();
}




private function resetInputFields(){
    $this->name = '';
    $this->email='';
    $this->user_id = '';
    $this->password='';
    $this->passwordConfirmation='';
    $this->role='';
    
    
}
public function create()
{
    $this->resetInputFields();
    $this->openModal();
}


}
