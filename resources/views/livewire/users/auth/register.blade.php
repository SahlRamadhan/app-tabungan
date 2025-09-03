<div>
    <div class="card">
        <div class="card-body pt-0">
            <form class="my-4" action="index.html">
                <div class="form-group mb-2">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="useremail">Email</label>
                    <input type="email" class="form-control" id="useremail" name="user email"
                        placeholder="Enter email">
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" class="form-control" name="password" id="userpassword"
                        placeholder="Enter password">
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="Confirmpassword">ConfirmPassword</label>
                    <input type="password" class="form-control" name="password" id="Confirmpassword"
                        placeholder="Enter Confirm password">
                </div><!--end form-group-->

                <div class="form-group mb-2">
                    <label class="form-label" for="mobileNo">Mobile Number</label>
                    <input type="text" class="form-control" id="mobileNo" name="mobile number"
                        placeholder="Enter Mobile Number">
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="button">Register <i
                                    class="fas fa-sign-in-alt ms-1"></i></button>
                        </div>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->
            <div class="text-center">
                <p class="text-muted">Already have an account ? <a href="{{ route('login') }}" class="text-primary ms-2">Log
                        in</a></p>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div>
