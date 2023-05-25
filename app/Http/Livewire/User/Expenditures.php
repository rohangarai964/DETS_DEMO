<?php

namespace App\Http\Livewire\User;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expenditure;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class Expenditures extends Component
{
    use WithPagination;
    public $expence_id;
    public $isOpen = 0;
    public $item_id;
    public $exp_date;
    public $qty;
    public $itemDropdown;
    public function render()
    {
    
        $perPage = 5;
        if(Auth::user()->role){
        $collection = Expenditure::select('expenditures.id','expenditures.exp_date','expenditures.qty','item_groups.group_name','items.item_name','items.item_price')->join('items', 'items.id', '=', 'expenditures.item_id')->join('item_groups','item_groups.id','=','items.item_group_id')->get();

        }
        else{
        $collection = Expenditure::select('expenditures.id','expenditures.exp_date','expenditures.qty','item_groups.group_name','items.item_name','items.item_price')->join('items', 'items.id', '=', 'expenditures.item_id')->join('item_groups','item_groups.id','=','items.item_group_id')->where('user_id',Auth::user()->id)->get();

        }
        
        $items = $collection->forPage($this->page, $perPage);

        $paginator = new LengthAwarePaginator($items, $collection->count(), $perPage, $this->page);
       

        return view('livewire.user.expenditures',[
            'exp' => $paginator  ]);
    }

    public function mount(){
        $this->itemDropdown=Item::select('item_name','id')->from('items')->get();
    }
     public function delete($id)
    {
        $this->expence_id = $id;
        Expenditure::find($id)->delete();
        $this->dispatchBrowserEvent('notify', 'Expenditure deleted Successfull');
    }
    public function edit($id)
    {
        $Expenditures = Expenditure::findOrFail($id);
        $this->expence_id = $id;
        $this->item_id = $Expenditures->item_id;
        $this->exp_date = $Expenditures->exp_date;
        $this->qty = $Expenditures->qty;
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
            'item_id' => 'required',
            'exp_date' => 'required|date',
            'qty' => 'required|numeric'

        ]);
        $data = array(
            'item_id' => $this->item_id,
            'exp_date' =>$this->exp_date,
            'qty'=> $this->qty,
            'user_id'=>Auth::user()->id
        );
        $Expenditures = Expenditure::updateOrCreate(['id' => $this->expence_id],$data);
        $this->dispatchBrowserEvent('notify', 'Expenditure Updated Successfull');
        $this->closeModal();
        $this->resetInputFields();
    }

   


    private function resetInputFields(){
        $this->item_id = '';
        $this->expence_id = '';
        $this->exp_date = '';
        $this->qty = '';
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
}
