<?php

namespace App\Livewire\Users\Transaksi;

use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PeminjamanUsers extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $pinjmanan = Pinjaman::with('user', 'jenisPembayaran')->where('user_id', Auth::user()->id)->get();
        return view('livewire.users.transaksi.peminjaman-users', compact('pinjmanan'));
    }
}
