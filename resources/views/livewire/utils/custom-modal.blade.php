<div>
    <div class="modal fade" id="custom-modal" aria-labelledby="vertical-center-modal" tabindex="-1"
         aria-hidden="@if($modalVisible) false @else true  @endif">
        <div class="modal-dialog {{ $size }} modal-dialog-centered modal-dialog-scrollable">
            @if ($modalVisible)
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-success text-white d-flex align-items-center">
                        <h4 class="modal-title text-white">
                            {{ $modalTitle }}
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @if($modalBody)
                            @livewire($modalBody['component'],$modalBody['params'] ?? [],key($modalBody['params']['id']
                            ?? uniqid()))
                        @else
                            {!! $modalView !!}
                        @endif
                    </div>

                    @if($showFooter)
                        <div class="modal-footer border-top">
                            <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
