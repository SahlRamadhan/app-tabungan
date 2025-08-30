<?php

namespace App\Livewire\Users\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    #[Layout('components.layouts.authlogin')]
    public function render()
    {
        return view('livewire.users.auth.login');
    }
}
