<div>
    <div class="card">
        <div class="card-body pt-0">
            <form wire:submit="login" class="my-4">
                <div class="form-group mb-2">
                    <label class="form-label" for="email">Email</label>
                    <input wire:model="email" type="text" class="form-control" id="email" name="email"
                        placeholder="Enter Email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input wire:model="password" type="password" class="form-control" name="password" id="password"
                        placeholder="Enter password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                        </div>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->
            <div class="text-center  mb-2">
                <p class="text-muted">Don't have an account ? <a href="{{ route('register') }}"
                        class="text-primary ms-2">Free Resister</a></p>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div>
