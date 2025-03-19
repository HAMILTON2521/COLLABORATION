<div class="main-wrapper overflow-hidden">
    <!-- ------------------------------------- -->
    <!-- Banner Start -->
    <!-- ------------------------------------- -->
    <section class="py-7 py-md-5 bg-light-gray">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
                <h2 class="fs-15 fw-bolder mb-0">
                    @if (isset($user))
                        Welcome, {{ $user->user->first_name }}
                    @else
                        Welcome to {{ config('app.name') }},
                    @endif
                </h2>
                <div class="d-flex align-items-center gap-6">
                    <a href="{{ route('web.home-page') }}" class="text-muted fw-bolder link-primary fs-3 text-uppercase">
                        Home
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-5 text-muted"></iconify-icon>
                    <a href="#" class="text-primary link-primary fw-bolder fs-3 text-uppercase">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- Banner End -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Form Start -->
    <!-- ------------------------------------- -->
    <section class="pb-lg-5 pb-3 bg-light-gray">
        <div class="container-fluid">
            <div class="row gx-lg-7 gy-lg-0 gy-7">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success text-success" role="alert">
                            <strong>Success - </strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (!$keyIsActive)
                        <div class="alert alert-danger text-danger" role="alert">
                            <strong>Failed - </strong> {{ $tokenMessage }}
                        </div>
                    @endif
                    @if (!$hasSetPassword && $keyIsActive)
                        <div class="card">
                            <div class="card-header text-bg-primary">
                                <h5 class="mb-0 text-white">Please set new password</h5>
                            </div>
                            <form wire:submit.prevent="setPassword">
                                <div>
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <x-password wire:model="password"
                                                        class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        placeholder="New password" />
                                                    <label>
                                                        <i class="ti ti-lock me-2 fs-4"></i>New Password
                                                    </label>
                                                    @error('password')
                                                        <span class="validation-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <x-password wire:model="password_confirmation"
                                                        name="password_confirmation"
                                                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                        placeholder="Confirm password" />
                                                    <label>
                                                        <i class="ti ti-lock me-2 fs-4"></i>Confirm Password
                                                    </label>
                                                    @error('password_confirmation')
                                                        <span class="validation-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <div class="form-actions text-end">
                                        <div class="card-body border-top">
                                            <x-primary-button class="mt-3 px-9 py-6">
                                                Submit <span wire:loading wire:target="setPassword"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- Form End -->
    <!-- ------------------------------------- -->
</div>
