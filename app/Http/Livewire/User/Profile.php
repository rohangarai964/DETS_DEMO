<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $password;
    public $user_id;
    public $confirmPassword;
    public $old_password;
    public $oldpassword;
    public $isOpen = 0;
    public function render()
    {
       

        return view('livewire.user.profile',[
            'profile'=>Auth::user()
        ]);
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        $this->dispatchBrowserEvent('notify', 'Logout Success');
        return redirect()->route('login');
       
    }  
    public function edit($id)
    {
       

        $Users = User::findOrFail($id);
        $this->user_id = $id;
        $this->old_password='';
        $this->oldpassword=$Users->password;
        $this->password='';
       $this->confirmPassword='';
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
        $this->validate([
            
           'old_password'=>[
            'required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->oldpassword)) {
                    $fail('Old Password didn\'t match');
                }
            },
        ],
            'password' => 'required|min:6|same:confirmPassword',
           
        ]);
        $data = array(
            'password' => Hash::make($this->password),
            
            
        );
        $Users = User::updateOrCreate(['id' => $this->user_id],$data);
        $this->dispatchBrowserEvent('notify', 'Password Updated successfully');
        $this->closeModal();
        $this->resetInputFields();
    //  
        
       
    }

   


    private function resetInputFields(){
        $this->password = '';
        $this->user_id = '';
       

    }

}
