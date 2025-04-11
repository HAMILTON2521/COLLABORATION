<div>
    <x-page-header mainTitle="Payments - {{ date('d M Y', strtotime('-1 day')) }}" subtitle="Payments" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <form class="position-relative">
                        <input type="text" class="form-control product-search ps-5" id="input-search"
                            placeholder="Search payments..." />
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                        <th>ID</th>
                        <th>Ref</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @forelse ($this->payments as $payment)
                            <!-- start row -->
                            <tr wire:key="{{ $payment->id }}" class="search-items">
                                <td>
                                    <div class="d-flex align-items-start">
                                        <h6>
                                            {{ $payment->txnId }}</h6>
                                    </div>
                                </td>
                                <td>{{ $payment->incomingRequest->reference }}</td>
                                <td>{{ join(' ', [$payment->customer->first_name, $payment->customer->last_name]) }}
                                </td>
                                <td>{{ $payment->formattedAmount }}</td>
                                <td>{{ $payment->msisdn }}</td>
                                <td>{{ date('d M Y H:i', strtotime($payment->created_at)) }}</td>
                                <td>
                                    <span
                                        class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                                </td>
                                <td>
                                    <div class="action-btn">
                                        <a href="{{ route('topup.payment.details', $payment->id) }}"
                                            class="text-primary edit">
                                            <i class="ti ti-info-circle fs-7"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- end row -->
                        @empty
                            <tr>
                                <td colspan="8">No payment data at the moment!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
