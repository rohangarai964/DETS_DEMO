<?php

namespace App\Http\Livewire\Itemgroup;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ItemGroup;
use Illuminate\Support\Facades\Auth;

class ItemGroups extends Component
{
    public $group_id;
    public $isOpen = 0;
    public $group_name;

    use WithPagination;
    public function render()
    {
        $perPage = 5;

        $collection = ItemGroup::select('item_groups.id','item_groups.group_name','users.name')->join('users', 'users.id', '=', 'item_groups.created_by')->get();

        $items = $collection->forPage($this->page, $perPage);

        $paginator = new LengthAwarePaginator($items, $collection->count(), $perPage, $this->page);
        return view('livewire.itemgroup.item-group',[
            'itemGroup' => $paginator
        ]);
    }
    public function delete($id)
    {
        $this->group_id = $id;
        ItemGroup::find($id)->delete();
        $this->dispatchBrowserEvent('notify', 'Item Group deleted Successfull');
    }
    public function edit($id)
    {
        $ItemGroups = ItemGroup::findOrFail($id);
        $this->group_id = $id;
        $this->group_name = $ItemGroups->group_name;
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
            'group_name' => 'required',
        ]);
        $data = array(
            'group_name' => $this->group_name,
            'created_by'=>Auth::user()->id
        );
        $itemGroup = ItemGroup::updateOrCreate(['id' => $this->group_id],$data);
        $this->dispatchBrowserEvent('notify', 'Item GroupUpdated Successfull');
        $this->closeModal();
        $this->resetInputFields();
    }

   


    private function resetInputFields(){
        $this->group_name = '';
        $this->group_id = '';
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
}
