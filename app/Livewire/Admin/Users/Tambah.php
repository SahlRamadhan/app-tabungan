<?php

namespace App\Livewire\Admin\Users;

use App\Models\Balances;
use App\Models\JenisPembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Tambah extends Component
{
    public $name, $email, $password, $password_confirmation, $no_telp, $alamat, $no_ktp, $amount, $simpan_pokok;

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
            'simpan_pokok' => 'nullable|integer|min:0',

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
        $user->simpan_pokok = $this->simpan_pokok ?? 0;

        $user->save();

        // ensure a JenisPembayaran named 'Cash' exists and attach it
        $jenis = JenisPembayaran::firstOrCreate([
            'name' => 'Cash'
        ], [
            'name' => 'Cash'
        ]);

        // If admin provided simpan_pokok, create a separate balance entry for the principal
        if (!empty($this->simpan_pokok) && $this->simpan_pokok > 0) {
            $pokok = new Balances();
            $pokok->user_id = $user->id;
            $pokok->jenispembayaran_id = $jenis->id;
            $pokok->amount = $this->simpan_pokok;
            $pokok->bukti_pembayaran = null;
            $pokok->status = 'in';
            $pokok->type = 'deposit';
            $pokok->approved_by_id = Auth::id();
            $pokok->approved_at = now();
            $pokok->save();
        }

        return redirect()->to('/admin/users');
    }
}
