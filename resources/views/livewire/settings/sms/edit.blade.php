<div>
    <form wire:submit.prevent="edit">
        <div class="mb-3">
            <label class="form-label" for="key">Key
                <x-required/>
            </label>
            <input disabled type="text" wire:model="key" class="form-control @error('key') is-invalid @enderror"
                   name="key" autocomplete="off">
            @error('key')
            <x-validation-error message="{{ $message }}"/>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="value">Value
                <x-required/>
            </label>
            <input type="text" wire:model="value" class="form-control @error('value') is-invalid @enderror"
                   name="value" autocomplete="off">
            @error('value')
            <x-validation-error message="{{ $message }}"/>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="type">Type
                <x-required/>
            </label>
            <input type="text" wire:model="type" class="form-control @error('type') is-invalid @enderror"
                   name="type" autocomplete="off">
            @error('type')
            <x-validation-error message="{{ $message }}"/>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea wire:model="description" rows="2" class="form-control @error('description') is-invalid @enderror"
                      name="description"></textarea>
            @error('description')
            <x-validation-error message="{{ $message }}"/>
            @enderror
        </div>
        <div class="modal-footer">
            <button type="button" data-bs-dismiss="modal" class="btn bg-danger-subtle text-danger">Close
            </button>
            <button type="submit" class="btn btn-primary">Save changes
                <x-spinner target="edit"/>
            </button>
        </div>
    </form>
</div>
<x-autosize/>
