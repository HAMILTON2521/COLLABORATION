<div>
    <x-page-header mainTitle="Device Data" subtitle="Data"/>
    <div class="card">
        <div class="card-body">
            <form wire:submit="queryDeviceData" autocomplete="off">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-text">Date Range </span>
                            <input name="startDate" wire:model="startDate" type="date" value="{{ $startDate }}"
                                   class="form-control {{ $errors->has('startDate') ? 'is-invalid' : '' }}"
                                   placeholder="From">
                            <input name="endDate" wire:model="endDate" type="date" value="{{ $endDate }}"
                                   class="form-control {{ $errors->has('endDate') ? 'is-invalid' : '' }}"
                                   placeholder="To">
                            <button class="btn btn-primary rounded-end" type="submit">
                                Submit
                                <x-spinner target="queryDeviceData"/>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @isset($deviceData)
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table search-table align-middle text-nowrap">
                            <thead class="header-item">
                            <tr>
                                <th>Name</th>
                                <th>Energy Type</th>
                                <th>Reading Time</th>
                                <th>Reading</th>
                                <th>Id</th>
                                <th>Level</th>
                                <th>Value Id</th>
                                <th>Valve</th>
                                <th>Voltage</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($deviceData as $data)
                                <!-- start row -->
                                <tr wire:key="{{ $data['id'] }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0">{{ $data['archivesName'] }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ $data['energyType'] }}</td>
                                    <td>{{ date('d M Y H:i', strtotime($data['meterReadingtime'])) }}</td>
                                    <td>{{ $data['freezeReading'] }}</td>
                                    <td>{{ $data['id'] }}</td>
                                    <td>{{ $data['level'] }}</td>
                                    <td>{{ $data['valueId'] }}</td>
                                    <td>
                                        @if ($data['valve'] == 1)
                                            <iconify-icon icon="tabler:lock-open-2" width="24" height="24"
                                                          class="text-success"></iconify-icon>
                                        @else
                                            <iconify-icon icon="tabler:lock" width="24" height="24"
                                                          class="text-danger"></iconify-icon>
                                        @endif
                                    </td>
                                    <td>{{ $data['voltage'] }}</td>
                                </tr>
                                <!-- end row -->
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No data available</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- pagination --}}
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>
