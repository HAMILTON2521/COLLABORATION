<div>
    <form wire:submit.prevent="edit">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Activity</h5>
                <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                    <input disabled type="text" wire:model="title"
                        class="form-control @error('title') is-invalid @enderror" name="title" autocomplete="off">
                    @error('title')
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
                <div class="mb-4">
                    <label class="form-label">Message Template</label>
                    <select class="form-select" wire:model="templateId">
                        <option value="">Select message template</option>
                        @foreach ($this->templates as $template)
                            <option value="{{ $template->id }}">{{ $template->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <div class="form-check">
                        <input wire:model="sendMessage" class="form-check-input" type="checkbox" id="flexCheckDefault"
                            name="sendMessage">
                        <label class="form-check-label" for="flexCheckDefault">
                            Send message for this activity
                        </label>
                    </div>
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
