<?php

namespace App\Livewire\Users\Transaksi;

use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AddPeminjaman extends Component
{
    public $uuid;
    public $name;
    public $no_ktp;
    public $no_hp;
    public $nominal;
    public $tenor;
    public $nominal_angsuran;
    public $tgl_pinjaman;

    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.users.transaksi.add-peminjaman');
    }

    public function mount()
    {
        $this->uuid = Auth::user()->uuid;
        $this->name = Auth::user()->name;
        $this->no_ktp = Auth::user()->no_ktp;
        $this->no_hp = Auth::user()->no_hp;
    }
    public function hitungAngsuranOtomatis()
    {
        // Pastikan nominal dan tenor tidak kosong dan tenor bukan nol untuk menghindari error pembagian
        if (!empty($this->nominal) && !empty($this->tenor) && $this->tenor > 0) {
            // Lakukan perhitungan dan bulatkan ke atas
            $this->nominal_angsuran = ceil((int)$this->nominal / (int)$this->tenor);
        } else {
            $this->nominal_angsuran = 0;
        }
    }
    public function updated($propertyName)
    {
        // Cek jika yang berubah adalah nominal atau tenor
        if ($propertyName === 'nominal' || $propertyName === 'tenor') {
            $this->hitungAngsuranOtomatis();
        }
    }
    public function submitPinjaman()
    {
        $rulers = [
            'nominal' => 'required|numeric',
            'tenor' => 'required|numeric',
        ];
        $this->validate($rulers);

        $no_pinjaman = 'PNJ' . mt_rand(100000, 999999);
        $pinjam = new Pinjaman();
        $pinjam->user_id = Auth::user()->id;
        $pinjam->jenispembayaran_id = 1;
        $pinjam->nomor_pinjaman = $no_pinjaman;
        $pinjam->nominal = $this->nominal;
        $pinjam->tenor = $this->tenor;
        $pinjam->nominal_angsuran = $this->nominal_angsuran;
        $pinjam->tgl_pinjaman = now();
        $pinjam->tgl_jatuhtempo = Carbon::parse($this->tgl_pinjaman)->addMonths((int)$this->tenor)->format('Y-m-d');
        $pinjam->save();

        return redirect()->to('/peminjaman');
    }
    public function cancel()
    {
        return redirect()->to('/peminjaman');
    }
}
