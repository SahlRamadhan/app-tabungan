<?php

namespace App\Livewire\Users\Dashboard;

use App\Models\Balances;
use Illuminate\Container\Attributes\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $balances = Balances::where('user_id', auth()->user()->id)->where('type', 'deposit')->where('status', 'in')->sum('amount');
        $totalUangKeluar = Balances::where('user_id', auth()->user()->id)->where('type', 'withdraw')->where('status', 'out')->sum('amount');
        return view('livewire.users.dashboard.dashboard', compact('balances', 'totalUangKeluar'));
    }
}
