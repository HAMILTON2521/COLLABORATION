@assets
<script src="{{ asset('assets/js/autosize.js') }}"></script>
@endassets
@script
<script>
    $(document).ready(function () {
        autosize($('textarea'));
    });
</script>
@endscript
