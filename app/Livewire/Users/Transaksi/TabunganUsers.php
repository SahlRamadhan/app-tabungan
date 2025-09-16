<?php

namespace App\Livewire\Users\Transaksi;

use App\Models\Balances;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TabunganUsers extends Component
{
    public $detailtransaksi;
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $totalUangKeluar = Balances::where('user_id', auth()->user()->id)->where('status', 'out')->sum('amount');
        $totalBalances = Balances::where('user_id', auth()->user()->id)->where('status', 'in')->sum('amount');
        $balances = Balances::where('user_id',auth()->user()->id)->with(['user', 'jenisPembayaran'])->get();
        return view('livewire.users.transaksi.tabungan-users', compact('balances', 'totalBalances', 'totalUangKeluar'));
    }

    public function detail($id)
    {
        $this->detailtransaksi = Balances::where('id', $id)->with(['user', 'jenisPembayaran'])->first();
    }
}
