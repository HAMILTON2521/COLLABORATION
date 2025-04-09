<div>
    <div class="modal fade" id="custom-modal" aria-labelledby="vertical-center-modal" tabindex="-1" aria-hidden="true">
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
                        {!! $modalBody !!}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@script
    <script>
        $wire.on('show-modal-data', (event) => {
            $("#custom-modal").modal('show');
        });
    </script>
@endscript
