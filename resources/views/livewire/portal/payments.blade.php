<div>
    <x-page-header mainTitle="User Payments" subtitle="Payments" />
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
                    <a href="{{ route('portal.payments.new') }}" id="btn-add-user"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-plus text-white me-1 fs-5"></i> New Payment
                    </a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success text-success" role="alert">
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif

        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                        <th>Transaction</th>
                        <th>Amount</th>
                        <th>Account</th>
                        <th>External ID</th>
                        <th>Channel</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @forelse ($this->payments as $payment)
                            <!-- start row -->
                            <tr wire:key="{{ $payment->id }}">
                                <td>
                                    <h6 class="mb-0">{{ $payment->txnId }}</h6>
                                </td>
                                <td>{{ $payment->formattedAmount }}</td>
                                <td>{{ $payment->customer->ref }}</td>
                                <td>{{ $payment->external_id }}</td>
                                <td>{{ $payment->channel }}</td>
                                <td>
                                    <span
                                        class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                                </td>
                                <td>{{ date('d M Y H:i', strtotime($payment->created_at)) }}</td>
                                <td>
                                    <x-action-buttons viewUrl="{{ route('topup.payment.details', $payment->id) }}" />

                                </td>
                            </tr>
                            <!-- end row -->
                        @empty
                            <tr>
                                <td colspan="8">There is no payments at the moment.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $this->payments->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
