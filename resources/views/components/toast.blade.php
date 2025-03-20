@script
    <script>
        $wire.on('showToast', (event) => {
            let options = {
                showMethod: "slideDown",
                hideMethod: "slideUp",
                progressBar: true,
                closeButton: true,
                positionClass: "toastr toast-top-center"
            };
            if (event.status == 'Success') {
                toastr.success(
                    event.message,
                    event.status, options);
            } else {
                toastr.error(
                    event.message,
                    event.status, options);
            }
        });
    </script>
@endscript
