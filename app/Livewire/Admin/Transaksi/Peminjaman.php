<?php

namespace App\Livewire\Admin\Transaksi;

use App\Models\Pinjaman;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Peminjaman extends Component
{
    use WithPagination;

    // Properti untuk filter dan pencarian
    public $search = '';
    public $statusFilter = '';

    // Menggunakan tema paginasi bootstrap
    protected $paginationTheme = 'bootstrap';

    // Reset halaman setiap kali ada perubahan pada filter atau pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $peminjaman = Pinjaman::with('user', 'jenisPembayaran')->get(); 
        return view('livewire.admin.transaksi.peminjaman', compact('peminjaman'));
    }
}
