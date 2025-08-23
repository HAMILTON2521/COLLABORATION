<div>
    <x-page-header mainTitle="Valve Control Records" subtitle="Equipment"/>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="queryData" autocomplete="off">
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
                                <x-spinner target="queryData"/>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @isset($records)
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table search-table align-middle text-nowrap">
                            <thead class="header-item">
                            <tr>
                                <th>Name</th>
                                <th>ID</th>
                                <th>IMEI</th>
                                <th>Execution Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Value Id</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($records as $data)
                                <!-- start row -->
                                <tr wire:key="{{ $data['id'] }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0">{{ $data['username'] }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ $data['id'] }}</td>
                                    <td>{{ $data['imei'] }}</td>
                                    <td>
                                        @if ($data['executionType'] == 1)
                                            <span class="badge rounded-pill  bg-success-subtle text-success">Open
                                                    valve</span>
                                        @else
                                            <span class="badge rounded-pill  bg-danger-subtle text-danger">Close
                                                    valve</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y H:i', strtotime($data['dateTime'])) }}</td>
                                    <td>{{ $data['status'] }}</td>
                                    <td>{{ $data['valueId'] }}</td>
                                </tr>
                                <!-- end row -->
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No data available</td>
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
