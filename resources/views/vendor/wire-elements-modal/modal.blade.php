<div>
    @isset($jsPath)
        <script>
            {!! file_get_contents($jsPath) !!}
        </script>
    @endisset
    @isset($cssPath)
        <style>
            {!! file_get_contents($cssPath) !!}
        </style>
    @endisset

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="wireElementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="myModalLabel">
                        Airtel Money
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @forelse($components as $id => $component)
                        <div id="component-{{ $id }}" class="component-container">
                            @livewire($component['name'], $component['arguments'], key($id))
                        </div>
                    @empty
                        <p>No components available.</p>
                    @endforelse
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Livewire.on('openModal', () => {
            var modal = new bootstrap.Modal(document.getElementById('wireElementModal'));
            modal.show();
        });

        Livewire.on('closeModal', () => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('wireElementModal'));
            modal.hide();
        });
    });
</script>
