<?php

namespace App\Livewire\Users\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.users.dashboard.dashboard');
    }
}
