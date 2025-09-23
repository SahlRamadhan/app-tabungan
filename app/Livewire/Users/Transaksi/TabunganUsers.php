<?php

namespace App\Livewire\Users\Transaksi;

use App\Models\Balances;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TabunganUsers extends Component
{
    public $detailtransaksi;
    public $initialPrincipal;
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $userId = Auth::id();
        $user   = User::findOrFail($userId);

        // === Saldo total berjalan ===
        $totalOut = Balances::where('user_id', $userId)
            ->where('type', 'withdraw')
            ->where('status', 'in')
            ->sum('amount');

        $totalIn = Balances::where('user_id', $userId)
            ->where('type', 'deposit')
            ->where('status', 'in')
            ->sum('amount');

        $netBalance = $totalIn - $totalOut; // saldo berjalan tanpa simpanan pokok
        $totalSaldo = $netBalance; // saldo berjalan + simpanan pokok

        // === Saldo bulan ini saja ===
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        $totalInThisMonth = Balances::where('user_id', $userId)
            ->where('type', 'deposit')
            ->where('status', 'in')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $totalOutThisMonth = Balances::where('user_id', $userId)
            ->where('type', 'withdraw')
            ->where('status', 'in')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');



        // Simpanan pokok tetap ditambahkan sekali
        $totalSaldoThisMonth = $totalInThisMonth;

        // semua transaksi user
        $balances = Balances::where('user_id', $userId)
            ->with(['user', 'jenisPembayaran'])
            ->latest()
            ->get();

        return view('livewire.users.transaksi.tabungan-users', compact(
            'balances',
            'totalIn',
            'totalOut',
            'netBalance',
            'totalSaldo',
            'totalInThisMonth',
            'totalOutThisMonth',
            'totalSaldoThisMonth',
            'user'
        ));
    }

    public function detail($id)
    {
        $this->detailtransaksi = Balances::where('id', $id)->with(['user', 'jenisPembayaran'])->first();

        if ($this->detailtransaksi && $this->detailtransaksi->user_id) {
            $this->initialPrincipal = Balances::where('user_id', $this->detailtransaksi->user_id)
                ->where('type', 'deposit')
                ->orderBy('created_at', 'asc')
                ->first();
        } else {
            $this->initialPrincipal = null;
        }
    }
}
