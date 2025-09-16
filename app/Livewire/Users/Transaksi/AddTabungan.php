<?php

namespace App\Livewire\Users\Transaksi;

use App\Models\Balances;
use App\Models\JenisPembayaran;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddTabungan extends Component
{
    use WithFileUploads;
    public $uuid;
    public $name;
    public $jenispembayaran_id;
    public $amount = 0;
    public $bukti_pembayaran;

    #[Layout('components.layouts.adminLayout')]
    public function mount()
    {
        $this->uuid = auth()->user()->uuid;
        $this->name = auth()->user()->name;
    }
    public function render()
    {
        $jenisPembayaran = JenisPembayaran::get();
        return view('livewire.users.transaksi.add-tabungan', compact('jenisPembayaran'));
    }

    public function submit()
    {
        $this->validate([
            'jenispembayaran_id' => 'required|exists:jenis_pembayarans,id',
            'amount' => 'required|numeric|min:1000',
            'bukti_pembayaran' => 'required|image|max:1024', // 1MB Max
        ]);

        if ($this->bukti_pembayaran) {
            $random = Str::random(10);
            $bukti_pembayaran = 'tabungan-' . $random . '.webp';
            $location = 'buktipembayaran/images/';
            $path = public_path($location . $bukti_pembayaran);

            $image = ImageManager::imagick()->read($this->bukti_pembayaran->path())->resize(200, 200)->save($path)->toWebp(90);

            file_put_contents($path, $image);
        }

        $balances = new Balances();
        $balances->user_id = auth()->user()->id;
        $balances->jenispembayaran_id = $this->jenispembayaran_id;
        $balances->amount = $this->amount;
        $balances->bukti_pembayaran = $bukti_pembayaran;
        $balances->save();

        return redirect()->to('/tabungan');
    }
}
