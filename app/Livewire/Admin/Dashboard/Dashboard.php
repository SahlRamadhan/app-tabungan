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
        return view('livewire.admin.dashboard.dashboard', compact('user', 'totalUangMasuk', 'totalUangKeluar', 'netBalance'));
    }
}
