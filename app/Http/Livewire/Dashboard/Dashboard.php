<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expenditure;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component

{
    use WithPagination;
   
    public function mount(){
         $cred=session()->all();
    }
    public function render()
    {
        $perPage = 5;
        if(Auth::user()->role){
            $collection = Expenditure::select('users.name','expenditures.exp_date','expenditures.qty','items.item_name','items.item_price')->join('items', 'items.id', '=', 'expenditures.item_id')->join('users','users.id','=','expenditures.user_id')->orderBy('users.id')->get();

        }
        else{
        $collection = Expenditure::select('users.name','expenditures.exp_date','expenditures.qty','items.item_name','items.item_price')->join('items', 'items.id', '=', 'expenditures.item_id')->join('users','users.id','=','expenditures.user_id')->where('user_id',Auth::user()->id)->orderBy('users.id')->get();

        }
        
        $items = $collection->forPage($this->page, $perPage);

        $paginator = new LengthAwarePaginator($items, $collection->count(), $perPage, $this->page);
       
        return view('livewire.dashboard.dashboard',[
            'exp' => $paginator  ]);
        
    }
    
}
