<?php

namespace App\Livewire\Admin\Transaksi;

use App\Models\Balances;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Tabungan extends Component
{
    public $detailtransaksi;
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $balances = Balances::with(['user', 'jenisPembayaran'])->get();
        return view('livewire.admin.transaksi.tabungan', compact('balances'));
    }

    public function terima($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            session()->flash('error', 'Unauthorized');
            return;
        }

        $balance = Balances::find($id);
        if (!$balance) {
            session()->flash('error', 'Record not found');
            return;
        }

        $balance->status = 'in';
        $balance->approved_by_id = Auth::id();
        $balance->approved_at = now();
        $balance->save();

        session()->flash('message', 'Transaksi diterima');
    }

    public function tolak($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            session()->flash('error', 'Unauthorized');
            return;
        }

        $balance = Balances::find($id);
        if (!$balance) {
            session()->flash('error', 'Record not found');
            return;
        }

        $balance->status = 'out';
        $balance->approved_by_id = Auth::id();
        $balance->approved_at = now();
        $balance->save();

        session()->flash('message', 'Transaksi ditolak');
    }

    public function detail($id)
    {
        $this->detailtransaksi = Balances::where('id', $id)->with(['user', 'jenisPembayaran'])->first();
    }
}
