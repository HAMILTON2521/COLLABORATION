<div>
    <x-page-header mainTitle="Recharge Device" subtitle="Topup"/>
    <div class="row">
        <div class="col-lg-7">
            <div class="card border-top border-success">
                <div class="px-4 py-3 border-bottom">
                    <h4 class="card-title mb-0">Customer Info</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Name</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->full_name }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Account</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->ref }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Phone</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->phone }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">IMEI</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->imei }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Status</p>
                            <h6 class="fw-semibold mb-0">
                                <x-status-badge color="{{ $customer->is_active_color }}"
                                                label="{{ $customer->is_active_label }}"/>
                            </h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Email</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->email??'-' }}</h6>
                        </div>
                        <div class="col-12 mb-7">
                            <p class="mb-1 fs-2">Address</p>
                            <h6 class="fw-semibold mb-0">
                                {{ join(', ', [$customer->district->name, $customer->region->name]) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-top border-primary">
                <div class="px-4 py-3 border-bottom">
                    <h4 class="card-title mb-0">Recharge</h4>
                </div>
                <div class="card-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-6" id="basic-addon1">
                                    <i class="ti ti-report-money fs-6"></i>
                                </span>
                                <input name="amount" id="number" type="number" wire:model="amount"
                                       class="form-control ps-2  @error('amount')
                                                    is-invalid
                                                @enderror"
                                       placeholder="Enter amount">
                                @error('amount')
                                <x-validation-error message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="ref" class="form-label">Payment reference <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text px-6" id="basic-addon1">
                                    <i class="ti ti-info-circle fs-6"></i>
                                </span>
                                <input name="ref" id="ref" type="text" wire:model="ref"
                                       class="form-control ps-2 @error('ref')
                                                    is-invalid
                                                @enderror"
                                       placeholder="Enter payment reference">
                                @error('ref')
                                <x-validation-error message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="remarks" class="form-label">Remarks</label>
                            <div class="input-group">
                                <span class="input-group-text px-6" id="basic-addon1">
                                    <i class="ti ti-message-2 fs-6"></i>
                                </span>
                                <textarea wire:model="remarks"
                                          class="form-control @error('remarks')
                                                    is-invalid
                                                @enderror p-7 ps-2"
                                          name="remarks" id="remarks" cols="20" rows="1"
                                          placeholder="Enter remarks for this payment"></textarea>
                                @error('remarks')
                                <x-validation-error message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit
                            <x-spinner target="save"/>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
