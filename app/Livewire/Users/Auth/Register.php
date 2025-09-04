<?php

namespace App\Livewire\Users\Auth;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;


class Register extends Component
{
    public $name, $email, $password, $password_confirmation, $no_telp, $alamat, $no_ktp, $no_rek;

    #[Layout('components.layouts.authregister')]
    public function render()
    {
        return view('livewire.users.auth.register');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password',
            'no_telp' => 'required|integer',
            'alamat' => 'nullable|string|max:255',
            'no_ktp' => 'required|integer',
            'no_rek' => 'required|integer',

        ]);

        $uuid = (string) mt_rand(1, 9999999999);
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->no_hp = $this->no_telp;
        $user->alamat = $this->alamat;
        $user->no_ktp = $this->no_ktp;
        $user->no_rek = $this->no_rek;
        $user->uuid = $uuid;

        $user->save();

        return redirect()->to('/login');
    }
}
