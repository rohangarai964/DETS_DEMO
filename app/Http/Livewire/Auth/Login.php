<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function login()
    {
        $attr = $this->validate();
        // print_r(Auth::attempt($attr));die();

        if (Auth::attempt($attr)) {
            $data=Auth::user();
            // print_r($data->id);die();
            $cred['id']=$data->id;
            $cred['name']=$data->name;
            $cred['email']=$data->email;
            session()->put('login_data', $cred);
            return redirect()->route('dashboard');
        }

        $this->dispatchBrowserEvent('notify', 'Login Failed');
        $this->reset(['password']);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

}
