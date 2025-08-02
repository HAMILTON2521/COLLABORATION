<div class="col-lg-12">
    <div class="card border-top border-success">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3 mb-9 justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">Recent Payments</h5>

                <div class="d-flex align-items-center justify-content-end gap-6">
                    <a href="{{ route('portal.payments') }}" type="button"
                        class="btn btn-rounded btn-outline-success">View
                        All</a>
                </div>
            </div>

            <div class="table-responsive" data-simplebar>
                <table class="table text-nowrap align-middle table-custom mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-normal ps-0">Transaction</th>
                            <th scope="col" class="fw-normal">External Id</th>
                            <th scope="col" class="fw-normal">Amount</th>
                            <th scope="col" class="fw-normal">Account</th>
                            <th scope="col" class="fw-normal">Channel</th>
                            <th scope="col" class="fw-normal">Status</th>
                            <th scope="col" class="fw-normal">Date</th>
                            <th scope="col" class="fw-normal">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center gap-6">
                                        <iconify-icon icon="solar:money-bag-bold"
                                            class="fs-7 text-success"></iconify-icon>
                                        <div>
                                            <h6 class="mb-0">{{ $payment->txnId }}</h6>
                                            <span>{{ $payment->msisdn }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{ $payment->external_id }}</span>
                                </td>
                                </td>
                                <td>
                                    <span>{{ $payment->formattedAmount }}</span>
                                </td>
                                <td>
                                    <span>{{ $payment->customer->ref }}</span>
                                </td>
                                <td>
                                    <span class="text-dark-light">{{ $payment->channel }}</span>
                                </td>
                                <td>
                                    <span
                                        class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                                </td>
                                <td>
                                    <span>{{ date('d M Y H:i', strtotime($payment->created_at)) }}</span>
                                </td>
                                <td>
                                    <x-action-buttons viewUrl="{{ route('topup.payment.details', $payment->id) }}" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    Your payments will show here.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
