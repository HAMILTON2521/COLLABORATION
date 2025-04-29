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
                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                            <x-input wire:model="phone" name="phone"
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="phone"
                                maxlength="10" />
                            @error('phone')
                                <span class="validation-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="amount">Amount (minimum is Tsh 200) <span class="text-danger">*</span></label>
                            <input wire:model="amount"
                                class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="amount"
                                type="number" id="amount">
                            @error('amount')
                                <span class="validation-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="p-3 border-top">
                    <div class="text-end">
                        <button wire:show="status" class="btn btn-rounded btn-primary" type="submit">
                            Submit <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                        </button>

                        @isset($selcomOrder)
                            <a href="{{ route('portal.account.buy', $customer->id) }}" class="btn btn-danger me-3"
                                type="button">
                                Cancel
                            </a>
                            @if (!$selcomOrder->is_paid)
                                <div wire:poll.5s="checkPaymentStatus">
                                    <p>Please complete payment on your phone. Waiting for confirmation...</p>
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success">
                                    Payment received! Thank you.
                                </div>
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
