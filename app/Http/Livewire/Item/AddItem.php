<?php

namespace App\Http\Livewire\Item;

use Livewire\Component;
use App\Models\Item;
use App\Models\ItemGroup;

class AddItem extends Component
{
    public Item $Items ;
    // public ItemGroup $itemGroups;
   

    protected $rules = [
        'Items.item_name' => 'required',
        'Items.item_price' => 'required|numeric',
        'Items.description' => 'required',
        'Items.item_group_id' => 'required',
       
    ];
    // public $item_dropdown=['itemDropdown'=>ItemGroup::all()];

    public function mount()
    {
        $this->Items = new Item();
       
        
    }
    public function save(){
        try {
            
            $this->validate();
            
            if($this->Items->save()){
                $this->dispatchBrowserEvent('notify', 'Item creatd Success');
                // $this->reset();
                return redirect()->to('item');
            }
    
            }
            catch (Throwable $e) {
                $this->dispatchBrowserEvent('notify', $e->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.item.add-item',[
            'itemGroupDropdown' => ItemGroup::select('group_name','id')->from('item_groups')->get()
        ]);
    }
}
