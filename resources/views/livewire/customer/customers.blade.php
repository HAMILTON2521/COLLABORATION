@push('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush
<div>
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Customers</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <x-dashboard-link />
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Customers
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="action-btn layout-top-spacing mb-7 d-flex align-items-center justify-content-end flex-wrap gap-6">
        <a href="{{ route('customers.create') }}" class="btn btn-primary" wire:navigate>
            <i class="ti ti-plus me-1 fs-5"></i> Add Customer</a>
    </div>
    <div class="datatables">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file_export" class="table w-100 table-striped table-bordered display text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>Name</th>
                                <th>Account</th>
                                <th>Region</th>
                                <th>District</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @forelse ($this->customers as $customer)
                                <tr wire:key="{{ $customer->id }}">
                                    <td>{{ $customer->full_name }}</td>
                                    <td>{{ $customer->ref }}</td>
                                    <td>{{ $customer->region }}</td>
                                    <td>{{ $customer->district }}</td>
                                    <td>{{ date('d M Y', strtotime($customer->created_at)) }}</td>
                                    <td>
                                        <x-action-buttons editUrl="{{ route('customers.edit', $customer->id) }}"
                                            deleteItem="{{ $customer->id }}"
                                            confirmationMessage="Delete customer {{ $customer->full_name }}"
                                            viewUrl="{{ route('customers.details', $customer->id) }}" />
                                    </td>
                                </tr>
                            @empty
                                <tr colspan=6>
                                    <td colspan="6" class="text-center">There are no customers to display!</td>
                                </tr>
                            @endforelse
                            <!-- end row -->
                        </tbody>
                        <tfoot>
                            <!-- start row -->
                            <tr>
                                <th>Name</th>
                                <th>Account</th>
                                <th>Region</th>
                                <th>District</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets/js/plugins/toastr-init.js') }}"></script>
@endpush
@script
    <script>
        $("#file_export").DataTable({
            dom: "Bfrtip",
            buttons: ["excel", "pdf", "print", "colvis"],
        });
        $(
            ".buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary");

        $wire.on('not-allowed', () => {
            toastr.error(
                "Delete is not enabled",
                "Failed", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    progressBar: true,
                    closeButton: true
                }
            );
        });
    </script>
@endscript
