@if (session('success'))
    <div id="alert" class="alert alert-success text-success" role="alert">
        <strong>Success - </strong> {{ session('success') }}
    </div>
@endif

@if (session('fail'))
    <div id="alert" class="alert alert-danger text-danger" role="alert">
        <strong>Failed - </strong> {{ session('fail') }}
    </div>
@endif

<script>
    setTimeout(function() {
        $("#alert").slideUp(500);
    }, 3000); // Disappears after 3 seconds
</script>
