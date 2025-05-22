<div>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $key }}</h5>
            <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label" for="value">Value</label>
                <input type="text" wire:model="value" class="form-control" name="value" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label" for="type">Type</label>
                <input type="text" wire:model="type" class="form-control" name="type" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea wire:model="description" rows="3" class="form-control" name="description" disabled></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary"
                wire:click="$dispatch('hideModal')">Close</button>
        </div>
    </div>
</div>
