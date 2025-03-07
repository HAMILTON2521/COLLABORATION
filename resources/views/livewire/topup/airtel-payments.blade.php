<div>
    <x-page-header mainTitle="Airtel Payments" subtitle="Topup" />
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
                        <th>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input primary" id="contact-check-all" />
                                    <label class="form-check-label" for="contact-check-all"></label>
                                    <span class="new-control-indicator"></span>
                                </div>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>Ref</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @forelse ($this->payments as $payment)
                            <!-- start row -->
                            <tr wire:key="{{ $payment->id }}" class="search-items">
                                <td>
                                    <div class="n-chk align-self-center text-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input contact-chkbox primary"
                                                id="checkbox1" />
                                            <label class="form-check-label" for="checkbox1"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="">
                                            <div class="user-meta-info">
                                                <h6 class="household-name mb-0" data-name="{{ $payment->id }}">
                                                    {{ Str::substr($payment->id, 0, 10) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="usr-email-addr"
                                        data-serialnumber="{{ $payment->airtelRequest->reference }}">{{ $payment->airtelRequest->reference }}</span>
                                </td>
                                <td>
                                    <span class="usr-email-addr"
                                        data-serialnumber="{{ join(' ', [$payment->customer->first_name, $payment->customer->last_name]) }}">{{ join(' ', [$payment->customer->first_name, $payment->customer->last_name]) }}</span>
                                </td>
                                <td>
                                    <span class="household-address"
                                        data-address="{{ $payment->amount }}">{{ number_format($payment->amount, 2) }}</span>
                                </td>
                                <td>
                                    <span class="household-fee"
                                        data-fee="{{ $payment->msisdn }}">{{ $payment->msisdn }}</span>
                                </td>
                                <td>
                                    <span
                                        class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                                </td>
                                <td>
                                    <div class="action-btn">
                                        <a href="javascript:;" class="text-primary edit">
                                            <i class="ti ti-eye fs-5"></i>
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
