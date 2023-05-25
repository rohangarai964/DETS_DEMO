<?php

namespace App\Http\Livewire\Item;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\ItemGroup;


class Items extends Component
{

    public $item_id;
    public $isOpen = 0;
    public $item_name;
    public $item_group_id;
    public $item_price;
    public $description;
    public $itemGroupDropdown;
    use WithPagination;

public function mount(){
    $this->itemGroupDropdown=ItemGroup::select('group_name','id')->from('item_groups')->get();
}

    public function render()
    {
        $perPage = 5;

        $collection = Item::select('items.id','item_groups.group_name','items.item_name','items.item_price','items.description')->join('item_groups', 'item_groups.id', '=', 'items.item_group_id')->get();

        $items = $collection->forPage($this->page, $perPage);

        $paginator = new LengthAwarePaginator($items, $collection->count(), $perPage, $this->page);
        return view('livewire.item.item',[
            'item' => $paginator
        ]);
    }

    public function delete($id)
    {
        $this->item_id = $id;
        Item::find($id)->delete();
        $this->dispatchBrowserEvent('notify', 'Item Group deleted Successfull');
    }
    public function edit($id)
    {
       

        $Items = Item::findOrFail($id);
        $this->item_id = $id;
        $this->item_group_id=$Items->item_group_id;
        $this->item_name = $Items->item_name;
        $this->item_price=$Items->item_price;
        $this->description=$Items->description;
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
            'item_name' => 'required',
            'item_group_id' => 'required',
            'item_price' => 'required|numeric',
            'description' => 'required',
        ]);
        $data = array(
            'item_name' => $this->item_name,
            'item_group_id' => $this->item_group_id,
            'item_price' => $this->item_price,
            'description' => $this->description,
            
        );
        $items = Item::updateOrCreate(['id' => $this->item_id],$data);
        $this->dispatchBrowserEvent('notify', 'Item GroupUpdated Successfull');
        $this->closeModal();
        $this->resetInputFields();
    }

   


    private function resetInputFields(){
        $this->item_name = '';
        $this->item_id = '';
        $this->item_group_id='';
        $this->item_price = '';
        $this->description='';

    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

}
