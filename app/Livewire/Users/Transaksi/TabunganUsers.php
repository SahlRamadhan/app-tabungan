<?php

namespace App\Livewire\Users\Transaksi;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TabunganUsers extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.users.transaksi.tabungan-users');
    }
}
