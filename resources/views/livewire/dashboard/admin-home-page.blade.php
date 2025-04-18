<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-4 pb-0" data-simplebar="">
                <div class="row flex-nowrap">
                    <div class="col">
                        <div class="card primary-gradient">
                            <div class="card-body text-center px-9 pb-4">
                                <div
                                    class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                    <iconify-icon icon="solar:users-group-rounded-linear"
                                        class="fs-7 text-white"></iconify-icon>
                                </div>
                                <h6 class="fw-normal fs-3 mb-1">Customers</h6>
                                <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                    {{ $this->countOfCustomers }}</h4>
                                <a href="{{ route('customers') }}"
                                    class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card warning-gradient">
                            <div class="card-body text-center px-9 pb-4">
                                <div
                                    class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
                                    <iconify-icon icon="solar:recive-twice-square-linear"
                                        class="fs-7 text-white"></iconify-icon>
                                </div>
                                <h6 class="fw-normal fs-3 mb-1">Today's Payments</h6>
                                <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                    {{ $this->payments['today'] }}</h4>
                                <a href="{{ route('topup.airtel.payments.today') }}"
                                    class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card secondary-gradient">
                            <div class="card-body text-center px-9 pb-4">
                                <div
                                    class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                                    <iconify-icon icon="ic:outline-backpack" class="fs-7 text-white"></iconify-icon>
                                </div>
                                <h6 class="fw-normal fs-3 mb-1">Y'day's Payments</h6>
                                <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                    {{ $this->payments['yesterday'] }}</h4>
                                <a href="{{ route('topup.airtel.payments.yday') }}"
                                    class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card danger-gradient">
                            <div class="card-body text-center px-9 pb-4">
                                <div
                                    class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                                    <iconify-icon icon="ic:baseline-sync-problem"
                                        class="fs-7 text-white"></iconify-icon>
                                </div>
                                <h6 class="fw-normal fs-3 mb-1">Failed Payments</h6>
                                <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                    {{ $this->payments['failedRecharge'] }}</h4>
                                <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card success-gradient">
                            <div class="card-body text-center px-9 pb-4">
                                <div
                                    class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                                    <iconify-icon icon="ic:outline-forest" class="fs-7 text-white"></iconify-icon>
                                </div>
                                <h6 class="fw-normal fs-3 mb-1">Total Collection</h6>
                                <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                    {{ $this->payments['total'] }}</h4>
                                <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                        <div class="mb-3 mb-sm-0">
                            <h4 class="card-title fw-semibold">Recent Payments</h4>
                            <p class="card-subtitle">Summary of recent payments</p>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">All</option>
                                <option value="2">Success</option>
                                <option value="3">Recharged</option>
                                <option value="4">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Customer</th>
                                    <th scope="col">Account</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @forelse ($this->payments['payments'] as $payment)
                                    <tr>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 pe-1">
                                                    <iconify-icon icon="solar:money-bag-bold"
                                                        class="fs-7 text-success"></iconify-icon>
                                                </div>
                                                <div>
                                                    <h6 class="fw-semibold mb-1">{{ $payment->customer->full_name }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-3">{{ $payment->customer->ref }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-3">{{ number_format($payment->amount) }}</p>
                                        </td>
                                        <td>
                                            <span
                                                class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                                        </td>
                                        <td>
                                            <p class="fs-3 text-dark mb-0">
                                                {{ date('d M Y H:i', strtotime($payment->created_at)) }}</p>
                                        </td>
                                        <td>
                                            <div class="action-btn">
                                                <a href="{{ route('topup.payment.details', $payment->id) }}"
                                                    class="text-primary edit">
                                                    <i class="ti ti-info-circle fs-6"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No payment details found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Payments Line Graph</h4>
            <div id="chart-line-basic"></div>
        </div>
    </div>

</div>
@assets
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard3.js') }}"></script>
    <script src="{{ asset('assets/js/apex-chart/apex.line.init.js') }}"></script>
@endassets
