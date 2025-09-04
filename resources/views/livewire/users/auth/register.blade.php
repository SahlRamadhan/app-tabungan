<div>
    <div class="card">
        <div class="card-body pt-0">
            <form wire:submit="register" class="my-4">
                <div class="form-group mb-2">
                    <label class="form-label" for="name">Name</label>
                    <input wire:model="name" type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="email">Email</label>
                    <input wire:model="email" type="email" class="form-control" id="email" name="email"
                        placeholder="Enter email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="password">Password</label>
                    <input wire:model="password" type="password" class="form-control" name="password" id="password"
                        placeholder="Enter password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="Confirmpassword">ConfirmPassword</label>
                    <input wire:model="password_confirmation" type="password" class="form-control" name="password"
                        id="Confirmpassword" placeholder="Enter Confirm password">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input wire:model="alamat" type="text" class="form-control" id="alamat" name="alamat"
                        placeholder="Enter Alamat">
                    @error('alamat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="no_nik">No NIK</label>
                    <input wire:model="no_ktp" type="number" class="form-control" id="no_nik" name="no_nik"
                        placeholder="Enter Nomer NIK">
                    @error('no_ktp')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="no_rek">No Rekening</label>
                    <input wire:model="no_rek" type="number" class="form-control" id="no_rek" name="no_rek"
                        placeholder="Enter Nomer Rekening">
                    @error('no_rek')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="no_telp">No Telepon</label>
                    <input wire:model="no_telp" type="number" class="form-control" id="no_telp" name="no_telp"
                        placeholder="Enter Nomer Telepon">
                    @error('no_telp')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary">Register <i
                                    class="fas fa-sign-in-alt ms-1"></i></button>
                        </div>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->
            <div class="text-center">
                <p class="text-muted">Already have an account ? <a href="{{ route('login') }}"
                        class="text-primary ms-2">Log
                        in</a></p>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div>
