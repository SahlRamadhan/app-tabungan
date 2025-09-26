<div>
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Form Input Pinjaman</h4>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form wire:submit.prevent="simpanPinjaman">
                        <div class="mb-3">
                            <label for="username" class="form-label">User</label>
                            <input type="text" class="form-control" id="username" aria-describedby="emailHelp"
                                placeholder="Masukkan Username" wire:model.live="query" autocomplete="off">
                            @if (!empty($users))
                                <ul class="list-group position-absolute w-100" style="z-index: 1000;">
                                    @foreach ($users as $user)
                                        <li class="list-group-item list-group-item-action"
                                            wire:click="selectUser('{{ $user->id }}')">
                                            {{ $user->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="mt-3">
                                @if ($selectedUser)
                                    <label for="user" class="form-label">UUID</label>
                                    <input type="text" id="user" class="form-control" readonly
                                        value="{{ $selectedUser ? $selectedUser['uuid'] : 'No user selected' }}">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="notelepon" class="form-label">Nominal</label>
                            <input type="number" class="form-control" id="notelepon" placeholder="Masukkan Nominal"
                                wire:model.live="nominal">
                            @error('nominal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nonik" class="form-label">Tenor</label>
                            <input type="number" class="form-control" id="nonik" placeholder="Masukkan Tenor"
                                wire:model.live="tenor">
                            @error('tenor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="notelepon" class="form-label">Nominal Angsuran</label>
                            <input type="number" class="form-control" id="notelepon" placeholder="Masukkan Nominal"
                                wire:model="nominal_angsuran">
                            @error('nominal_angsuran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="simpan_pokok" class="form-label">Tanggal Pinjaman</label>
                            <input type="date" class="form-control" id="simpan_pokok"
                                placeholder="Masukkan Tanggal Pinjaman" wire:model="tgl_pinjaman">
                            @error('tgl_pinjaman')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Tambah</button>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div><!--end row-->
</div>
