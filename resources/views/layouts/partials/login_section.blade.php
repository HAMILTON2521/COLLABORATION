<div class="col-xl-6 border-end">
    <div class="row justify-content-center py-4">
        <div class="col-lg-11">
            <div class="card-body">
                <a href="{{ route('login') }}" class="text-nowrap logo-img d-block mb-4 w-100">
                    <img src="{{ asset('assets/images/logos/logo.svg') }}" class="dark-logo" alt="Logo-Dark" />
                </a>
                <h2 class="lh-base mb-4">Let's get you signed in</h2>

                <div class="position-relative text-center my-4">
                    <p class="mb-0 fs-12 px-3 d-inline-block bg-body z-index-5 position-relative">Sign in with
                        email
                    </p>
                    <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <a class="text-primary link-dark fs-2" href="{{ route('login.forgot_password') }}">Forgot
                                Password ?</a>
                        </div>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                Keep me logged in
                            </label>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.home') }}" class="btn btn-dark w-100 py-8 mb-4 rounded-1">Sign In</a>
                    <div class="d-flex align-items-center">
                        <p class="fs-12 mb-0 fw-medium">Don’t have an account yet?</p>
                        <a class="text-primary fw-bolder ms-2" href="{{ route('login.signup') }}">Sign Up Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>