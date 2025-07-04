@script
<script>
    $wire.on('show-modal-data', (event) => {
        $("#custom-modal").modal('show');
    });

    $wire.on('hide-modal-data', (event) => {
        $("#custom-modal").modal('hide');
    });
</script>
@endscript
