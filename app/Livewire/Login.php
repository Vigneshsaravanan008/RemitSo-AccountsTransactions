<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email,$password;

    protected $rules = [
        'email'=>'required|email',
        'password'=>'required|min:8'
    ];

    protected $message =[
        'email.email'=>'Enter the Valid Email Address',
        'password'=>'Enter the password'
    ];

    public function updated($value)
    {
        $this->validateOnly($value);
    }

    public function loginForm()
    {
        $this->validate();
<<<<<<< HEAD
        if(Auth::guard('web')->attempt(['email'=>$this->email, 'password'=>$this->password]))
        {
            return redirect()->route('web.dashboard');
=======
        if(Auth::attempt(['email'=>$this->email, 'password'=>$this->password]))
        {
            return redirect()->intended('dashboard');
>>>>>>> 40dbd0d (changes in auth and transactions)
        }else{
            if(User::where('email',$this->email)->exists())
            {
                $this->dispatch('checkPassword',message: 'Password is Incorrect',parameter:'Password');
                return true;
            }else{
                $this->dispatch('checkPassword',message: 'Email is Incorrect',parameter:'Email');
                return true;
            }
        }
    }

    public function mount()
    {
<<<<<<< HEAD
        if(Auth::guard("web")->check())
=======
        if(Auth::check())
>>>>>>> 40dbd0d (changes in auth and transactions)
        {
            return redirect()->route('web.dashboard');
        }
    }

    public function render()
    {
        return view('livewire.login')->extends('website.auth-layouts.master')->section('content');
    }
}
