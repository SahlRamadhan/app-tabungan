<?php

namespace App\Livewire\Users\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    #[Layout('components.layouts.authregister')]
    public function render()
    {
        return view('livewire.users.auth.register');
    }
}
