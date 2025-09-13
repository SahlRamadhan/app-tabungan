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
        $balances = Balances::sum('amount');
        return view('livewire.admin.dashboard.dashboard', compact('user', 'balances'));
    }
}
