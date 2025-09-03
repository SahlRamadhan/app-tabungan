<div>
    <div class="card">
        <div class="card-body pt-0">
            <form class="my-4" action="index.html">
                <div class="form-group mb-2">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div><!--end form-group-->

                <div class="form-group">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" class="form-control" name="password" id="userpassword"
                        placeholder="Enter password">
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="button">Log In <i
                                    class="fas fa-sign-in-alt ms-1"></i></button>
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
