<div class="col-xl-6 border-end">
    <div class="row justify-content-center py-4">
        <div class="col-lg-11">
            <div class="card-body">
                <a href="{{ route('login') }}" class="text-nowrap logo-img d-block mb-4 w-100">
                    <img style="width: 60%" src="{{ asset('assets/images/logos/logo.png') }}" class="dark-logo"
                        alt="Logo-Dark" />
                </a>
                <h2 class="lh-base mb-4">Let's get you signed up</h2>

                <div class="position-relative text-center my-4">
                    <p class="mb-0 fs-12 px-3 d-inline-block bg-body z-index-5 position-relative">Sign up with
                        email
                    </p>
                    <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form>
                    <div class="mb-3">
                        <label for="text-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="text-name" placeholder="Enter your name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                            placeholder="Enter your email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                        </div>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter your password">
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        </div>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Confirm your password">
                    </div>
                    <a href="javascript:;" class="btn btn-dark w-100 py-8 mb-4 rounded-1">Sign Up</a>
                    <div class="d-flex align-items-center">
                        <p class="fs-12 mb-0 fw-medium">Already have an Account?</p>
                        <a class="text-primary fw-bolder ms-2" href="{{ route('login') }}">Sign in Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
