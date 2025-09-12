<?php

namespace App\Livewire\Admin\Users;

use App\Models\Balances;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Tambah extends Component
{
    public $name, $email, $password, $password_confirmation, $no_telp, $alamat, $no_ktp, $amount;

    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.admin.users.tambah');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'no_ktp' => 'required|string|max:20',

        ]);

        $uuid = (string) mt_rand(1, 9999999999);
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->no_hp = $this->no_telp;
        $user->alamat = $this->alamat;
        $user->no_ktp = $this->no_ktp;
        $user->uuid = $uuid;

        $user->save();

        $balances = new Balances();
        $balances->user_id = $user->id;
        $balances->amount = $this->amount ?? 0;
        $balances->status = 'in';
        $balances->save();

        return redirect()->to('/admin/users');
    }
}
