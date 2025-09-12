<div>
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Form Input User</h4>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form wire:submit="register">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="name" class="form-control" id="username" aria-describedby="emailHelp"
                                placeholder="Masukkan Username" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Email" wire:model="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Masukkan Password" wire:model="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confrimpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confrimpassword"
                                placeholder="Masukkan Confirm Password" wire:model="password_confirmation">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="notelepon" class="form-label">Telepon</label>
                            <input type="number" class="form-control" id="notelepon"
                                placeholder="Masukkan Nomer Telepon" wire:model="no_telp">
                            @error('no_telp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nonik" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nonik" placeholder="Masukkan NIK"
                                wire:model="no_ktp">
                            @error('no_ktp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nonik" class="form-label">Uang Pokok</label>
                            <input type="number" class="form-control" id="nonik" placeholder="Masukkan Uang Pokok"
                                wire:model="amount">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nonik" class="form-label">Alamat</label>
                            <textarea class="form-control" wire:model="alamat" id="alamat" cols="30" rows="10"></textarea>
                            @error('alamat')
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
