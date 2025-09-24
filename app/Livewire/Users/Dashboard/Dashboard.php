<?php

namespace App\Livewire\Users\Dashboard;

use App\Models\Balances;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
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

        $totalTransaksi = Balances::where('user_id', $userId)
            ->where('status', 'in')
            ->count();
        return view('livewire.users.dashboard.dashboard', compact('user', 'totalSaldo', 'totalIn', 'totalOut', 'netBalance', 'totalTransaksi'));
    }
}
