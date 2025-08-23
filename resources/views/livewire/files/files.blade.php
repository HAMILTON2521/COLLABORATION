<div>
    <x-page-header mainTitle="Get Archive List" subtitle="Files"/>

    <div class="card card-body">
        <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                <th>ID</th>
                <th>Customer</th>
                <th>Serial No</th>
                <th>Balance</th>
                <th>Readings</th>
                <th>Valve Status</th>
                <th>Phone</th>
                <th>Actions</th>
                </thead>
                <tbody>

                @forelse ($files as $file)
                    <!-- start row -->
                    <tr wire:key="{{ $file['id'] }}" class="search-items">
                        <td>
                            <div class="d-flex align-items-start">
                                <h6>
                                    {{ $file['id'] }}</h6>
                            </div>
                        </td>
                        <td>{{ $file['customerName'] }}</td>
                        <td>{{ $file['customerSerialnumber'] }}</td>
                        <td>{{ $file['balance'] }}</td>
                        <td>{{ $file['readings'] }}</td>
                        <td>
                            @if ($file['valveStatus'] === 1)
                                <iconify-icon icon="tabler:lock-open-2" width="24" height="24"
                                              class="text-success"></iconify-icon>
                            @else
                                <iconify-icon icon="tabler:lock" width="24" height="24"
                                              class="text-danger"></iconify-icon>
                            @endif
                        </td>
                        <td>{{ $file['phone'] }}</td>
                        <td>
                            <ul class="list-unstyled mb-0 d-flex align-items-center">
                                <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="View">
                                    <a class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                       href="javascript:;">
                                        <i class="ti ti-info-circle"></i>
                                    </a>
                                </li>
                                {{--                                <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"--}}
                                {{--                                    data-bs-title="View">--}}
                                {{--                                    <a class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"--}}
                                {{--                                       href="{{ route('files.meter.file.details', $file['deveui']) }}">--}}
                                {{--                                        <i class="ti ti-info-circle"></i>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                            </ul>
                        </td>
                    </tr>
                    <!-- end row -->
                @empty
                    <tr>
                        <td colspan="7">No file data at the moment!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
