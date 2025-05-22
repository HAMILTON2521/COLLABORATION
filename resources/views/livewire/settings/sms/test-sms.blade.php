<div>
    <form wire:submit.prevent="testSms">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test SMS</h5>
                <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="phone">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" autocomplete="off" placeholder="255xxxx">
                    @error('phone')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="message">Message <span class="text-danger">*</span></label>
                    <textarea wire:model="message" rows="2" class="form-control @error('message') is-invalid @enderror"
                        name="message"></textarea>
                    @error('message')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input wire:model='type' class="form-check-input success" type="radio"
                            name="radio-solid-success" id="success-radio" value="text">
                        <label class="form-check-label" for="success-radio">Text</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input wire:model='type' class="form-check-input success" type="radio"
                            name="radio-solid-success" id="success2-radio" value="flash">
                        <label class="form-check-label" for="success2-radio">Flash</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary"
                    wire:click="$dispatch('hideModal')">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
