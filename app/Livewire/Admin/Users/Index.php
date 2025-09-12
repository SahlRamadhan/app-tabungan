<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public $name_id, $email_id, $no_hp_id, $alamat_id, $no_ktp_id;
    public $edit_id;
    public $formEdit = false;
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $users = User::where('role', 'user')->with('balances')->get();
        return view('livewire.admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $this->formEdit = true;
        $user = User::where('id', $id)->first();
        $this->edit_id = $id;
        $this->name_id = $user->name;
        $this->email_id = $user->email;
        $this->no_hp_id = $user->no_hp;
        $this->alamat_id = $user->alamat;
        $this->no_ktp_id = $user->no_ktp;
    }

    public function update()
    {
        $this->validate([
            'name_id' => 'required|string|max:255',
            'email_id' => 'required|string|email|max:255',
            'no_hp_id' => 'required|string|max:15',
            'alamat_id' => 'nullable|string|max:255',
            'no_ktp_id' => 'required|string|max:20',

        ]);

        $user = User::where('id', $this->edit_id)->first();
        $user->name = $this->name_id;
        $user->email = $this->email_id;
        $user->no_hp = $this->no_hp_id;
        $user->alamat = $this->alamat_id;
        $user->no_ktp = $this->no_ktp_id;

        $user->save();

        $this->formEdit = false;
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->status = 'inactive';
            $user->save();
        }
    }
}
