<?php

namespace App\Livewire\Users\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;
    #[Layout('components.layouts.authlogin')]
    public function render()
    {
        return view('livewire.users.auth.login');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];


        if (Auth::attempt($credentials)) {
            session()->regenerate();
            $user = Auth::user();
            if ($user->status !== 'active') {
                Auth::logout();
                return redirect()->to('/login')->with('error', 'Akun Anda Tidak Aktif');
            }
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        } else {
            session()->flash('error', 'Email atau password salah!');
        }
    }
}
