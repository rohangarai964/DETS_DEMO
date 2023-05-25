<?php

namespace App\Http\Livewire\Itemgroup;

use Livewire\Component;
use App\Models\ItemGroup;
use Throwable;

class AddItemGroup extends Component
{
   
    public ItemGroup $ItemGroups ;

    protected $rules = [
        'ItemGroups.group_name' => 'required',
       
    ];

    public function mount()
    {
        $this->ItemGroups = new ItemGroup();
       
       
        
    }

    public function save()
    {
        $cred=session()->get('login_data');
        // print_r($cred);die();
        $this->ItemGroups->setAttribute('created_by', $cred['id']);
        
        try {
        // print('ok');die();
        $this->validate();
        //  print_r($attr['ItemGroups']['group_name']);die();
        // $this->ItemGroups.created_by=1;
        // $this->users->password = time();
        
        // print_r($this->ItemGroups);die();

        if($this->ItemGroups->save()){
            $this->dispatchBrowserEvent('notify', 'Item Group creatd Success');
            // $this->reset();
            return redirect()->to('itemGroup');
        }

        }
        catch (Throwable $e) {
            $this->dispatchBrowserEvent('notify', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.itemgroup.add-item-group');
    }


}
