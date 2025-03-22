<div>
    <x-page-header mainTitle="Create Customer" subtitle="Customers" />
    <x-form wire:submit="save" autocomplete="off" class="form-horizontal">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card border-top border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-7">
                            <h4 class="card-title">Customer Details</h4>

                            <button class="navbar-toggler border-0 shadow-none d-md-none" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight">
                                <i class="ti ti-menu fs-5 d-flex"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="first_name" class="form-label">First Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.first_name" name="first_name"
                                        class="form-control {{ $errors->has('form.first_name') ? 'is-invalid' : '' }}" />
                                    @error('form.first_name')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="last_name" class="form-label">Last Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.last_name" name="last_name"
                                        class="form-control {{ $errors->has('form.name') ? 'is-invalid' : '' }}" />
                                    @error('form.last_name')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="ref" class="form-label">Account <span class="text-danger">*</span>
                                    </label>
                                    <x-input maxlength="6" wire:model="form.account" name="ref"
                                        class="form-control {{ $errors->has('form.account') ? 'is-invalid' : '' }}" />
                                    @error('form.account')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-4">
                                    <label for="imei" class="form-label">IMEI <span class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.imei" name="imei"
                                        class="form-control {{ $errors->has('form.imei') ? 'is-invalid' : '' }}" />
                                    @error('form.imei')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.phone" name="phone" maxlength="10"
                                        class="form-control {{ $errors->has('form.phone') ? 'is-invalid' : '' }}" />
                                    @error('form.phone')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email </label>
                                    <input wire:model="form.email" name="email" id="email" type="email"
                                        class="form-control {{ $errors->has('form.email') ? 'is-invalid' : '' }}">
                                    @error('form.email')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-4">
                                    <label for="region" class="form-label">Region <span
                                            class="text-danger">*</span></label>
                                    <select wire:model.live="form.region"
                                        class="form-select mr-sm-2  {{ $errors->has('form.region') ? 'is-invalid' : '' }}"
                                        id="region">
                                        <option value="" disabled>Choose region...</option>
                                        @foreach ($this->regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.region')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-4">
                                    <label for="district" class="form-label">District <span
                                            class="text-danger">*</span></label>
                                    <select wire:model.live="form.district"
                                        class="form-select mr-sm-2  {{ $errors->has('form.district') ? 'is-invalid' : '' }}"
                                        id="district" wire:key="{{ $this->form->region }}">
                                        <option value="" disabled>Choose district...</option>
                                        @foreach (\App\Models\District::where('region_id', $this->form->region)->orderBy('name', 'asc')->get() as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.district')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="street" class="form-label">Street <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.street" name="street"
                                        class="form-control {{ $errors->has('form.street') ? 'is-invalid' : '' }}" />
                                    @error('form.street')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                            role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </x-form>
</div>
<x-toast />
