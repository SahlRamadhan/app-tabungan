<?php

namespace App\Livewire\Admin\Transaksi;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TambahPeminjaman extends Component
{
    // Properti untuk form
    public $user_id;
    public $nominal;
    public $tenor;
    public $tgl_pinjaman;
    public $nominal_angsuran;

    public $query = ''; // inputan admin
    public $users = []; // hasil pencarian
    public $selectedUser = null;

    public $range;
    public $bulan;
    public $tahun;
    public $type;
    public $jenisPembayaran;
    public $status;
    public $detailtransaksi;


    public function updated($propertyName)
    {
        // Cek jika yang berubah adalah nominal atau tenor
        if ($propertyName === 'nominal' || $propertyName === 'tenor') {
            $this->hitungAngsuranOtomatis();
        }
    }

    /**
     * Fungsi untuk menghitung nominal angsuran secara otomatis.
     */
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

    public function updatedQuery()
    {
        $this->users = User::where('name', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get();
    }

    public function selectUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->selectedUser = $user;
            $this->query = $user->name; // isi input dengan nama
            $this->users = []; // hapus suggestion setelah dipilih
        }
    }

    // Fungsi utama untuk menyimpan pinjaman
    public function simpanPinjaman()
    {
        // $this->validate([
        //     'user_id' => 'required',
        //     'nominal' => 'required|numeric',
        //     'tenor' => 'required|numeric',
        //     'tgl_pinjaman' => 'required|date',
        // ]);

        $no_pinjaman = 'PNJ' . mt_rand(100000, 999999);
        $pinjam = new Pinjaman();
        $pinjam->user_id = $this->selectedUser->id;
        $pinjam->jenispembayaran_id = 1;
        $pinjam->nomor_pinjaman = $no_pinjaman;
        $pinjam->nominal = $this->nominal;
        $pinjam->tenor = $this->tenor;
        $pinjam->nominal_angsuran = $this->nominal_angsuran;
        $pinjam->tgl_pinjaman = now();
        $pinjam->tgl_jatuhtempo = Carbon::parse($this->tgl_pinjaman)->addMonths((int)$this->tenor)->format('Y-m-d');
        $pinjam->status = 'approved';
        $pinjam->approved_by_id = Auth::id();
        $pinjam->save();

        $no_angsuran = 'ANG' . date('Ymd') . '0001';
        $angsuran = new Angsuran();
        $angsuran->pinjaman_id = $pinjam->id;
        $angsuran->user_id = $pinjam->user_id;
        $angsuran->jenispembayaran_id = null;
        $angsuran->nomor_angsuran = $no_angsuran;
        $angsuran->nominal = $pinjam->nominal_angsuran;
        $angsuran->sisa_pinjaman = $pinjam->nominal;
        $angsuran->tgl_jatuhtempo = Carbon::parse($pinjam->tgl_pinjaman)->addMonth();
        $angsuran->status = 'belum';
        $angsuran->save();

        redirect()->to('/admin/peminjaman');
    }

    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        return view('livewire.admin.transaksi.tambah-peminjaman');
    }
}
