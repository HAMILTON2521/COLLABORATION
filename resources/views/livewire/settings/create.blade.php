<div>
    <form wire:submit.prevent="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Setting</h5>
                <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="key">Key <span class="text-danger">*</span></label>
                    <input type="text" wire:model="key" class="form-control @error('key') is-invalid @enderror"
                        name="key" autocomplete="off">
                    @error('key')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="value">Value <span class="text-danger">*</span></label>
                    <input type="text" wire:model="value" class="form-control @error('value') is-invalid @enderror"
                        name="value" autocomplete="off">
                    @error('value')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="type">Type e.g string, integer <span
                            class="text-danger">*</span></label>
                    <input type="text" wire:model="type" class="form-control @error('type') is-invalid @enderror"
                        name="type" autocomplete="off">
                    @error('type')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea wire:model="description" rows="2" class="form-control @error('description') is-invalid @enderror"
                        name="description"></textarea>
                    @error('description')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary"
                    wire:click="$dispatch('hideModal')">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
