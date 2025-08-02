<div>
    <x-page-header mainTitle="Valve Control" subtitle="Equipment" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-2 col-xl-1">
                    <select wire:model.live="perPage" class="form-select w-auto">
                        @foreach ($this->pages as $page)
                            <option value="{{ $page }}">{{ $page }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="position-relative">
                        <x-input name="search" wire:model.live.debounce.500ms="search"
                            class="form-control product-search ps-5" placeholder="Search ..." />
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                <div
                    class="col-md-6 col-xl-8 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <a href="{{ route('more.equipment.valve.new') }}" id="btn-add-user"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-plus text-white me-1 fs-5"></i> Send New Command
                    </a>
                </div>
            </div>
        </div>
        <x-alert-status />

        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                        <th>Device Id</th>
                        <th>Customer Name</th>
                        <th>State</th>
                        <th>Source</th>
                        <th>Payment Id</th>
                        <th>Status</th>
                        <th>Value Id</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @forelse ($this->valveControls as $data)
                            <!-- start row -->
                            <tr wire:key="{{ $data->id }}">
                                <td><a wire:navigare class="link-success"
                                        href="{{ route('customers.details', $data->customer_id) }}">{{ $data->customer->imei }}</a>
                                </td>
                                <td>{{ $data->customer->full_name }}</td>
                                <td>
                                    @if ($data->state)
                                        <iconify-icon icon="tabler:lock-open-2" width="24" height="24"
                                            class="text-success"></iconify-icon>
                                    @else
                                        <iconify-icon icon="tabler:lock" width="24" height="24"
                                            class="text-danger"></iconify-icon>
                                    @endif
                                </td>
                                <td>{{ $data->source }}</td>
                                <td>
                                    @if ($data->source == 'Payment')
                                        <a class="link-success"
                                            href="{{ route('topup.payment.details', $data->payment_id) }}">{{ $data->payment->txnId }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <x-status-badge color="{{ $data->status_color }}"
                                        label="{{ $data->error_code == '0' ? 'Success' : 'Failed' }}" />
                                </td>
                                <td>{{ $data->value_id }}</td>
                                <td>{{ date('d M Y H:i', strtotime($data->created_at)) }}</td>

                                <td>
                                    <ul class="list-unstyled mb-0 d-flex align-items-center">
                                        <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="View">
                                            <a class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                                href="{{ route('more.equipment.valve.details', $data->id) }}">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </li>
                                        <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Delete">
                                            <button type="button" wire:confirm="Delete Valve Control?"
                                                wire:click="delete('{{ $data->id }}')"
                                                class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5 btn btn-sm border-0">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- end row -->
                        @empty
                            <tr>
                                <td colspan="9">No data at the moment!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $this->valveControls->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
