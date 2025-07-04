<div>
    <x-page-header mainTitle="Create Household" subtitle="Households"/>
    <x-form wire:submit="save" autocomplete="off" class="form-horizontal">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-7">
                            <h4 class="card-title">Household Details</h4>

                            <button class="navbar-toggler border-0 shadow-none d-md-none" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight">
                                <i class="ti ti-menu fs-5 d-flex"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Household Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.name" name="name"
                                             class="form-control {{ $errors->has('form.name') ? 'is-invalid' : '' }}"/>
                                    @error('form.name')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.phone" name="phone" maxlength="10"
                                             class="form-control {{ $errors->has('form.phone') ? 'is-invalid' : '' }}"/>
                                    @error('form.phone')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="warn_money" class="form-label">Warn Money <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input wire:model="form.warn_money" name="warn_money" id="warn_money" type="number"
                                           class="form-control {{ $errors->has('form.warn_money') ? 'is-invalid' : '' }}">
                                    @error('form.warn_money')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                    <p class="fs-2">Alarm will be issued when the balance is lower than amount.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="fee" class="form-label">Fee </label>
                                    <input wire:model="form.fee" name="fee" id="fee" type="number"
                                           class="form-control {{ $errors->has('form.fee') ? 'is-invalid' : '' }}">
                                    @error('form.fee')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                    <p class="fs-2">The pre-deposited amount when opening an account.</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span>
                                    </label>
                                    <x-textarea wire:model="form.address" rows="2" name="address"
                                                class="form-control {{ $errors->has('form.address') ? 'is-invalid' : '' }}"/>
                                    @error('form.address')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                        <x-spinner target="save"/>
                    </button>
                </div>
            </div>
        </div>
    </x-form>
</div>
@push('js')
    <script src="{{ asset('assets/js/plugins/toastr-init.js') }}"></script>
@endpush
@script
<script>
    $wire.on('household-create-success', () => {
        toastr.success(
            "Household created successfully",
            "Success", {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                progressBar: true,
                closeButton: true
            }
        );
    });

    $wire.on('household-create-failed', () => {
        toastr.error(
            "Failed to create household",
            "Failed", {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                progressBar: true,
                closeButton: true
            }
        );
    });
</script>
@endscript
