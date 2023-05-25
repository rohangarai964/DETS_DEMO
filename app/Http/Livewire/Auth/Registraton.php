<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Throwable;

class Registraton extends Component
{

    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $name='';

    protected $rules = [
        'email' => 'required|email|unique:users,email',
        'name'=> 'required',
        'password' => 'required|min:6|same:passwordConfirmation',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $attr = $this->validate();
        // print('ok');die();

        try {
            User::create([
                'name' => $attr['name'],
                'email' => $attr['email'],
                'password' => Hash::make($attr['password']),
            ]);

            $this->dispatchBrowserEvent('notify', 'Registration Success');
            $this->reset();

            // Or redirect with return redirect()->route('something');
            return redirect()->route('login');
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('notify', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.auth.registraton');
    }
}
