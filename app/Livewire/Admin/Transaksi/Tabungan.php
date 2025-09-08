<?php

namespace App\Livewire\Admin\Transaksi;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Tabungan extends Component
{
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.admin.transaksi.tabungan');
    }
}
