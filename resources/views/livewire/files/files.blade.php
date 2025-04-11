<div>
    <x-page-header mainTitle="Get Archive List" subtitle="Files" />

    <div class="card card-body">
        <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Serial No</th>
                    <th>IMEI</th>
                    <th>Readings</th>
                    <th>Valve Status</th>
                    <th>Energy</th>
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
                            <td>{{ $file['deveui'] }}</td>
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
                            <td>{{ $file['energyType'] }}</td>
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
