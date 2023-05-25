<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Dashboard extends Component

{
   
    public function mount(){
         $cred=session()->all();
    }
    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
    
}
