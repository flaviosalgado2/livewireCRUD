<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        //dd('veja as coisas: ', $this);
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('sua.rota.protegida'); // Altere para a rota da sua tela protegida
        }

        session()->flash('error', 'Credenciais inválidas.');
    }

    public function render()
    {
        return view('livewire.login');
    }

}

