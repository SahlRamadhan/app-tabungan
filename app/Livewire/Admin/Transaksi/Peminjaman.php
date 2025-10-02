<?php

namespace App\Livewire\Admin\Transaksi;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function terima($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            session()->flash('error', 'Unauthorized');
            return;
        }
        $pinjam = Pinjaman::with('user', 'jenisPembayaran')->find($id);

        if (!$pinjam) {
            session()->flash('error', 'Pinjaman tidak ditemukan');
            return;
        }
        $pinjam->status = 'approved';
        $pinjam->approved_by_id = Auth::id();
        $pinjam->save();

        $no_angsuran = 'ANG' . mt_rand(100000, 999999);
        $angsuran = new Angsuran();
        $angsuran->pinjaman_id = $pinjam->id;
        $angsuran->user_id = $pinjam->user_id;
        $angsuran->jenispembayaran_id = null;
        $angsuran->nomor_angsuran = $no_angsuran;
        $angsuran->sisa_pinjaman = $pinjam->nominal;
        $angsuran->tgl_jatuhtempo = Carbon::parse($pinjam->tgl_pinjaman)->addMonth();
        $angsuran->status = 'belum';
        $angsuran->save();
    }

    public function tolak($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            session()->flash('error', 'Unauthorized');
            return;
        }
        $pinjam = Pinjaman::find($id);
        $pinjam->status = 'rejected';
        $pinjam->save();
    }
}
