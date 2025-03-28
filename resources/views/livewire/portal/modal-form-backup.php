<form autocomplete="off" wire:submit.prevent="save">
    <div class="mb-3">
        <label for="phone">Phone Number <span class="text-danger">*</span></label>
        <x-input wire:model="phone" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
            type="phone" maxlength="10" />
        @error('phone')
        <span class="validation-text text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="amount">Amount (minimum is Tsh 100) <span class="text-danger">*</span></label>
        <input wire:model="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="amount"
            type="number" id="amount">
        @error('amount')
        <span class="validation-text text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3 text-center">
        <button class="btn btn-rounded bg-info-subtle text-info me-3" type="submit">
            Submit <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </button>
    </div>
</form>