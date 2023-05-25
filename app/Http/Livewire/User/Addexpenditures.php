<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Item;
use App\Models\Expenditure;

class Addexpenditures extends Component
{
    public Expenditure $Expenditures ;
    // public ItemGroup $itemGroups;
   

    protected $rules = [
        'Expenditures.exp_date' => 'required|date',
        'Expenditures.qty' => 'required|numeric',
       
        'Expenditures.item_id' => 'required',
       
    ];
    // public $item_dropdown=['itemDropdown'=>ItemGroup::all()];

    public function mount()
    {
        $this->Expenditures = new Expenditure();
       
        
    }
    public function save(){
        try {
            $cred=session()->get('login_data');
        
            $this->Expenditures->setAttribute('user_id', $cred['id']);
            
            $this->validate();
            
            if($this->Expenditures->save()){
                $this->dispatchBrowserEvent('notify', 'Expenditures creatd Success');
                // $this->reset();
                return redirect()->to('user/expenditure');
            }
    
            }
            catch (Throwable $e) {
                $this->dispatchBrowserEvent('notify', $e->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.user.addexpenditures',[
            'itemDropdown' => Item::select('item_name','id')->from('items')->get()
        ]);
    } 
   
}
