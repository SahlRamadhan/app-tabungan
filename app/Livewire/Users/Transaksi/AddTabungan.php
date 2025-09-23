<?php

namespace App\Livewire\Users\Transaksi;

use App\Models\Balances;
use App\Models\JenisPembayaran;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddTabungan extends Component
{
    use WithFileUploads;
    public $uuid;
    public $name;
    public $jenispembayaran_id;
    public $amount = 0;
    public $bukti_pembayaran;
    public $type = 'deposit';

    #[Layout('components.layouts.adminLayout')]
    public function mount()
    {
        $this->uuid = Auth::user()->uuid;
        $this->name = Auth::user()->name;
        // accept ?type=withdraw or ?type=deposit
        if (request()->has('type') && in_array(request()->get('type'), ['deposit', 'withdraw'])) {
            $this->type = request()->get('type');
        }
    }
    public function render()
    {
        $jenisPembayaran = JenisPembayaran::get();
        return view('livewire.users.transaksi.add-tabungan', compact('jenisPembayaran'));
    }

    public function submit()
    {
        // Determine selected jenis name to decide whether bukti_pembayaran is required
        $jenis = JenisPembayaran::find($this->jenispembayaran_id);

        $rules = [
            'jenispembayaran_id' => 'required|exists:jenis_pembayarans,id',
            'amount' => 'required|numeric|min:1000',
        ];

        // If jenis is not cash (case-insensitive) then bukti_pembayaran is required
        if ($jenis && strtolower($jenis->name) !== 'cash') {
            $rules['bukti_pembayaran'] = 'required|image|max:1024'; // 1MB Max
        } else {
            // ensure it's nullable when not required
            $rules['bukti_pembayaran'] = 'nullable|image|max:1024';
        }

        $this->validate($rules);

        $bukti_pembayaran_filename = null;

        if ($this->bukti_pembayaran) {
            $random = Str::random(10);
            $bukti_pembayaran_filename = 'tabungan-' . $random . '.webp';
            $location = 'buktipembayaran/images/';
            $path = public_path($location . $bukti_pembayaran_filename);

            $image = ImageManager::imagick()->read($this->bukti_pembayaran->path())->resize(200, 200)->save($path)->toWebp(90);

            file_put_contents($path, $image);
        }

        // If this is a withdraw, check available balance
        if ($this->type === 'withdraw') {
            $totalIn = Balances::where('user_id', Auth::id())->where('type', 'deposit')->where('status', 'in')->sum('amount');
            $totalOut = Balances::where('user_id', Auth::id())->where('type', 'withdraw')->where('status', 'in')->sum('amount');
            $available = $totalIn - $totalOut;

            if ($this->amount > $available) {
                $this->addError('amount', 'Saldo tidak mencukupi untuk melakukan withdraw.');
                return;
            }
        }

        $balances = new Balances();
        $balances->user_id = Auth::user()->id;
        $balances->jenispembayaran_id = $this->jenispembayaran_id;
        $balances->amount = $this->amount;
        $balances->type = $this->type;
        $balances->bukti_pembayaran = $bukti_pembayaran_filename;
        $balances->approved_by_id = null;
        $balances->approved_at = null;
        $balances->save();

        return redirect()->to('/tabungan');
    }

    public function cancel()
    {
        return redirect()->to('/tabungan');
    }
}
