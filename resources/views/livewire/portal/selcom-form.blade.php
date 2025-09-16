<div>
    <x-page-header mainTitle="Buy Gas" subtitle="Account" />
    <div class="card">
        <div class="card-header text-bg-primary">
            <h5 class="mb-0 text-white">{{ $customer->ref }}</h5>
        </div>
        <form class="form-horizontal" autocomplete="off" wire:submit.prevent="save">
            <div class="form-body">
                <div class="card-body">
                    <h6 class="card-title mb-0">Enter phone number and amount. PIN confirmation will be sent to
                        your phone for confirmation.</h6>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="phone">Phone Number <x-required /></label>
                            <x-input wire:model="phone" name="phone"
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="phone"
                                maxlength="10" />
                            @error('phone')
                                <x-validation-error :message=$message />
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="amount">Amount (minimum is Tsh 200) <x-required /></label>
                            <input wire:model="amount"
                                class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="amount"
                                type="number" id="amount">
                            @error('amount')
                                <x-validation-error :message=$message />
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="p-3 border-top">
                    <div class="text-end">
                        <button wire:show="status" class="btn btn-rounded btn-primary" type="submit">
                            Submit <x-spinner target="save" />
                        </button>

                        @isset($selcomOrder)
                            @if (!$selcomOrder->is_paid)
                                @if ($selcomOrder->status === 'Failed')
                                    <div class="alert customize-alert alert-dismissible text-danger alert-light-danger bg-danger-subtle fade show remove-close-icon"
                                        role="alert">
                                        <span class="side-line bg-danger"></span>

                                        <div class="d-flex align-items-center ">
                                            <i class="ti ti-info-circle fs-5 text-danger me-2 flex-shrink-0"></i>
                                            <span class="text-truncate">Transaction failed. Please try again.</span>

                                        </div>
                                    </div>
                                @else
                                    <div wire:poll.5s="checkPaymentStatus">
                                        <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
                                            role="alert">
                                            <span class="side-line bg-success"></span>

                                            <div class="d-flex align-items-center ">
                                                <i class="ti ti-info-circle fs-5 text-secondary me-2 flex-shrink-0"></i>
                                                <span class="text-truncate">Please complete payment on your phone. Waiting
                                                    for
                                                    confirmation...</span>
                                                <div class="ms-auto d-flex justify-content-end">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
