<div>
    @if ($formEdit)
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Form Edit Jenis Pembayaran</h4>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form wire:submit="update">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                placeholder="Masukkan name" wire:model="name_id">
                            @error('name_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" aria-describedby="emailHelp"
                                placeholder="Masukkan Keterangan" wire:model="keterangan_id">
                            @error('keterangan_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Update</button>
                        <a wire:click="$set('formEdit', false)" class="btn btn-danger">Kembali</a>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    @else
        <div class="row justify-content-center mt-3">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Form Input Jenis Pembayaran</h4>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <form wire:submit="tambah">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                    placeholder="Masukkan name" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" aria-describedby="emailHelp"
                                    placeholder="Masukkan Keterangan" wire:model="keterangan">
                                @error('keterangan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Tambah</button>
                            {{-- <a wire:click="$set('formEdit', false)" class="btn btn-danger">Kembali</a> --}}
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

        <div class="">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table  mb-0 table-centered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Keterangan</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenis as $pembayaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pembayaran->name }}</td>
                                            <td>{{ $pembayaran->keterangan }}</td>
                                            <td class="text-end">
                                                <a wire:click="edit({{ $pembayaran->id }})"><i
                                                        class="las la-pen text-secondary font-16"></i></a>
                                                <a wire:click="delete({{ $pembayaran->id }})"><i
                                                        class="las la-trash-alt text-secondary font-16"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->

    @endif

</div>
