<?php

namespace App\Livewire\Admin\JenisPembayaran;

use App\Models\JenisPembayaran as ModelsJenisPembayaran;
use Livewire\Attributes\Layout;
use Livewire\Component;

class JenisPembayaran extends Component
{
    public $name, $keterangan;
    public $formEdit = false;
    public $name_id, $keterangan_id, $edit_id;

    #[Layout('components.layouts.adminLayout')]
    public function render()
    {
        $jenis = ModelsJenisPembayaran::get();
        return view('livewire.admin.jenis-pembayaran.jenis-pembayaran', compact('jenis'));
    }

    public function tambah()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jenis = new ModelsJenisPembayaran();
        $jenis->name = $this->name;
        $jenis->keterangan = $this->keterangan;

        $jenis->save();

        return redirect()->to('/admin/jenis-pembayaran');
    }

    public function edit($id)
    {
        $this->formEdit = true;
        $jenis = ModelsJenisPembayaran::where('id', $id)->first();
        $this->edit_id = $id;
        $this->name_id = $jenis->name;
        $this->keterangan_id = $jenis->keterangan;
    }

    public function update()
    {
        $this->validate([
            'name_id' => 'required|string|max:255',
            'keterangan_id' => 'nullable|string',
        ]);

        $jenis = ModelsJenisPembayaran::where('id', $this->edit_id)->first();
        $jenis->name = $this->name_id;
        $jenis->keterangan = $this->keterangan_id;

        $jenis->save();

        $this->formEdit = false;
    }

    public function delete($id)
    {
        $jenis = ModelsJenisPembayaran::where('id', $id)->first();
        if ($jenis) {
            $jenis->delete();
        }
    }
}
