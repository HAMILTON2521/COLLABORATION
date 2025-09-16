<div class="col-xl-6 border-end">
    <div class="row justify-content-center py-4">
        <div class="col-lg-11">
            <div class="card-body">
                <a href="{{ route('login') }}" class="text-nowrap logo-img d-block mb-4 w-100">
                    <img style="width: 60%" src="{{ asset('assets/images/logos/logo.png') }}" class="dark-logo"
                        alt="{{ config('app.name') }}" />
                </a>
                <h2 class="lh-base mb-4">Let's get you signed in</h2>

                <div class="position-relative text-center my-4">
                    <p class="mb-0 fs-12 px-3 d-inline-block bg-body z-index-5 position-relative">Sign in with
                        email
                    </p>
                    <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form method="POST" action="{{ route('login-post') }}" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Email Address or Phone Number</label>
                        <input name="user_name" id="name="user_name"" type="text"
                            class="form-control {{ $errors->has('user_name') ? 'is-invalid' : '' }}"
                            placeholder=" Enter your email or phone number">
                        @error('user_name')
                            <x-validation-error :message=$message />
                        @enderror

                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <x-password class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Enter your password" />
                        @error('password')
                            <x-validation-error :message=$message />
                        @enderror

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                            <input wire:model="remember" name="remember" class="form-check-input primary"
                                type="checkbox" value="" id="remember_me">
                            <label class="form-check-label text-dark" for="remember_me">
                                Remember me
                            </label>
                        </div>
                        <a class="text-primary link-dark fs-2" href="{{ route('password.request') }}">Forgot
                            Password ?</a>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-8 mb-4 rounded-1">Sign In</button>
                    <div class="d-flex align-items-center">
                        <p class="fs-12 mb-0 fw-medium">Don’t have an account yet?</p>
                        <a class="text-primary fw-bolder ms-2" href="{{ route('signup') }}">Sign Up
                            Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
