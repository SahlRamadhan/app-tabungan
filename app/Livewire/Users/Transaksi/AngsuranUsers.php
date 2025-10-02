<?php

namespace App\Livewire\Users\Transaksi;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AngsuranUsers extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.users.transaksi.angsuran-users');
    }
}
