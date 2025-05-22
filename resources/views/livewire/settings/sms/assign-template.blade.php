<div>
    <form wire:submit.prevent="assign">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Template</h5>
                <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label class="form-label">Message Template</label>
                    <select class="form-select" wire:model="templateId">
                        <option value="">Select message template</option>
                        @foreach ($this->templates as $template)
                            <option value="{{ $template->id }}">{{ $template->title }}</option>
                        @endforeach
                    </select>
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
