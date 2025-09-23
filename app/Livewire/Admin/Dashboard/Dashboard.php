<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Balances;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $user  = User::where('role', 'user')->count();
        $totalUangMasuk = Balances::where('status', 'in')->where('type', 'deposit')->sum('amount');
        $totalUangKeluar = Balances::where('status', 'in')->where('type', 'withdraw')->sum('amount');
        $netBalance = $totalUangMasuk - $totalUangKeluar;

        $startOfMonth = now()->startOfMonth();
        $endOfMonth   = now()->endOfMonth();

        $uangMasukBulanIni = Balances::where('status', 'in')
            ->where('type', 'deposit')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $uangKeluarBulanIni = Balances::where('status', 'in')
            ->where('type', 'withdraw')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $userBaruBulanIni = User::where('role', 'user')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        return view('livewire.admin.dashboard.dashboard',compact(
                'user',
                'totalUangMasuk',
                'totalUangKeluar',
                'netBalance',
                'uangMasukBulanIni',
                'uangKeluarBulanIni',
                'userBaruBulanIni',
            )
        );
    }
}
