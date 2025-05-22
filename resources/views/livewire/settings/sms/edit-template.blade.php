<div>
    <form wire:submit.prevent="edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Message Template</h5>
                <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror"
                        name="title" autocomplete="off">
                    @error('title')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="icon">Icon (ti-icon) </label>
                    <input type="text" wire:model="icon" class="form-control @error('icon') is-invalid @enderror"
                        name="icon" autocomplete="off">
                    @error('icon')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea wire:model="description" rows="1" class="form-control @error('description') is-invalid @enderror"
                        name="description"></textarea>
                    @error('description')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="placeholders">Placeholders <span class="text-danger">*</span></label>
                    <textarea wire:model="placeholders" rows="2" class="form-control @error('placeholders') is-invalid @enderror"
                        name="placeholders"></textarea>
                    @error('placeholders')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="body">Body <span class="text-danger">*</span></label>
                    <textarea wire:model="body" rows="2" class="form-control @error('body') is-invalid @enderror" name="body"></textarea>
                    @error('body')
                        <x-validation-error message="{{ $message }}" />
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary"
                    wire:click="$dispatch('hideModal')">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </form>
</div>
