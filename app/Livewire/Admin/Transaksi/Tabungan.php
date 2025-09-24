<?php

namespace App\Livewire\Admin\Transaksi;

use App\Models\Balances;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Tabungan extends Component
{
    use WithPagination;

    public $search = '';

    public $query = ''; // inputan admin
    public $users = []; // hasil pencarian
    public $selectedUser = null;

    public $amount;

    public $range;
    public $bulan;
    public $tahun;
    public $type;
    public $jenisPembayaran;
    public $status;
    public $detailtransaksi;
    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $filters = [
            'range' => $this->range,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'type' => $this->type,
            'jenisPembayaran' => $this->jenisPembayaran,
            'status' => $this->status,
        ];


        $balances = Balances::filter($filters)->search($this->search)->latest()->paginate(10);
        return view('livewire.admin.transaksi.tabungan', compact('balances'));
    }

    public function addTransaksi()
    {
        if (!$this->selectedUser) {
            session()->flash('error', 'Please select a user first.');
            return;
        }

        if (!$this->amount || $this->amount < 1000) {
            session()->flash('error', 'Amount must be at least 1000.');
            return;
        }

        $balance = new Balances();
        $balance->user_id = $this->selectedUser->id;
        $balance->amount = $this->amount;
        $balance->type = $this->type;
        $balance->jenispembayaran_id = 1;
        $balance->status = 'in';
        $balance->approved_by_id = Auth::id();
        $balance->approved_at = now();
        $balance->save();

        $this->reset(['query', 'users', 'selectedUser', 'amount', 'type']);
        session()->flash('message', 'Transaction added successfully.');
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
    public function updating($field)
    {
        // setiap kali filter berubah, reset ke halaman pertama
        $this->resetPage();
    }

    public function setRange($value)
    {
        $this->range = $value;
        $this->resetPage();
    }

    public function terima($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            session()->flash('error', 'Unauthorized');
            return;
        }

        $balance = Balances::with('user')->find($id);
        if (!$balance) {
            session()->flash('error', 'Record not found');
            return;
        }

        // setujui transaksi
        $balance->status = 'in';
        $balance->approved_by_id = Auth::id();
        $balance->approved_at = now();
        $balance->save();

        $user = $balance->user;

        // hitung total tabungan (deposit - withdraw)
        $totalIn = Balances::where('user_id', $user->id)
            ->where('type', 'deposit')
            ->where('status', 'in')
            ->sum('amount');

        $totalOut = Balances::where('user_id', $user->id)
            ->where('type', 'withdraw')
            ->where('status', 'in')
            ->sum('amount');

        // saldo murni transaksi
        $saldoTransaksi = $totalIn - $totalOut;

        // tambahkan simpanan pokok (field di users)
        $totalSaldo = $saldoTransaksi + ($user->simpan_pokok ?? 0);

        session()->flash('message', 'Transaksi diterima. Saldo total user sekarang: Rp ' . number_format($totalSaldo, 0, ',', '.'));
    }

    public function tolak($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            session()->flash('error', 'Unauthorized');
            return;
        }

        $balance = Balances::find($id);
        if (!$balance) {
            session()->flash('error', 'Record not found');
            return;
        }

        $balance->status = 'rejected';
        $balance->approved_by_id = Auth::id();
        $balance->approved_at = now();
        $balance->save();

        session()->flash('message', 'Transaksi ditolak');
    }

    public function detail($id)
    {
        $this->detailtransaksi = Balances::where('id', $id)->with(['user', 'jenisPembayaran'])->first();
    }
}
