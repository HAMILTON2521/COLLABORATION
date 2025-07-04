<div>
    <x-page-header mainTitle="Create User" subtitle="Users" />
    <x-form wire:submit="save" autocomplete="off">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fill the form to create a new user</h4>
                        <p class="card-subtitle mb-3">
                            All fields are mandatory
                        </p>
                        <form wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.first_name" type="text"
                                            class="form-control @error('form.first_name')
                                                is-invalid
                                            @enderror"
                                            placeholder="First name" />
                                        <label>
                                            <i class="ti ti-user me-2 fs-4"></i>First Name
                                        </label>
                                        @error('form.first_name')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.last_name" type="text"
                                            class="form-control @error('form.last_name')
                                                is-invalid
                                            @enderror"
                                            placeholder="Last name" />
                                        <label>
                                            <i class="ti ti-user me-2 fs-4"></i>Last Name
                                        </label>
                                        @error('form.last_name')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.email" type="email"
                                            class="form-control @error('form.email')
                                                is-invalid
                                            @enderror"
                                            placeholder="Email" />
                                        <label>
                                            <i class="ti ti-mail me-2 fs-4"></i>Email address
                                        </label>
                                        @error('form.email')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.phone" type="phone" maxlength="10"
                                            class="form-control @error('form.phone')
                                                is-invalid
                                            @enderror"
                                            placeholder="Phone" />
                                        <label>
                                            <i class="ti ti-phone me-2 fs-4"></i>Phone Number
                                        </label>
                                        @error('form.phone')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select wire:model="form.user_type"
                                            class="form-select @error('form.user_type')
                                                is-invalid
                                            @enderror">
                                            <option value="" disabled>Choose...</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">Normal User</option>
                                        </select>
                                        <label>
                                            <i class="ti ti-user me-2 fs-4"></i>User Type
                                        </label>
                                        @error('form.user_type')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <x-password wire:model="form.password"
                                            class="form-control {{ $errors->has('form.password') ? 'is-invalid' : '' }}"
                                            placeholder="Password" />
                                        <label>
                                            <i class="ti ti-lock me-2 fs-4"></i>Password
                                        </label>
                                        @error('form.password')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <x-password wire:model="form.password_confirmation" name="password_confirmation"
                                            class="form-control {{ $errors->has('form.password_confirmation') ? 'is-invalid' : '' }}"
                                            placeholder="Confirm password" />
                                        <label>
                                            <i class="ti ti-lock me-2 fs-4"></i>Confirm Password
                                        </label>
                                        @error('form.password_confirmation')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="sf1" value="1"
                                        checked disabled />
                                    <label class="form-check-label" for="sf1">User MUST change password on first
                                        login</label>
                                </div>
                                <div class="mt-3 mt-md-0 ms-auto">
                                    <x-primary-button class="mt-3 px-9 py-6" wire:loading.attr="disabled"
                                        wire:target="save">
                                        Save Changes <x-spinner target="save"/>
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-form>
</div>
<x-toast />
