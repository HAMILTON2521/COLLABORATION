<div>
    <x-page-header mainTitle="Payment Details" subtitle="Topup"/>
    <x-alert-status/>
    <div class="card border-top border-success">
        <div class="card-header">
            <h5 class="mb-0">{{ date('d M Y H:i', strtotime($payment->created_at)) }}</h5>
        </div>
        <form class="form-horizontal">
            <div class="form-body">
                <div class="card-body">
                    <h5 class="card-title mb-0">Payment Info</h5>
                </div>
                <hr class="m-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Amount</p>
                            <h6 class="fw-semibold mb-0">Tsh {{ $payment->formattedAmount }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Transaction ID</p>
                            <h6 class="fw-semibold mb-0">{{ $payment->txnId }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Account</p>
                            <h6 class="fw-semibold mb-0">{{ $payment->customer->ref }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Customer</p>
                            <h6 class="fw-semibold mb-0">{{ $payment->customer->full_name }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Phone number</p>
                            <h6 class="fw-semibold mb-0">{{ $payment->msisdn }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Channel</p>
                            <h6 class="fw-semibold mb-0">{{ $payment->channel }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">External Id</p>
                            <h6 class="fw-semibold mb-0">{{ $payment->external_id }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Status</p>
                            <h6 class="fw-semibold mb-0"><span
                                    class="mb-1 badge rounded-pill  bg-{{ $payment->status_color }}-subtle text-{{ $payment->status_color }}">{{ $payment->status }}</span>
                            </h6>
                        </div>
                        @isset($payment->incomingRequest->remarks)
                            <div class="col-12 mb-7">
                                <p class="mb-1 fs-2">Remarks</p>
                                <h6 class="fw-semibold mb-0">{{ $payment->incomingRequest->remarks }}</h6>
                            </div>
                        @endisset
                    </div>

                </div>
                <hr class="m-0">
                <div class="card-body">
                    <h5 class="card-title mb-0">Meter Recharge Request</h5>
                </div>
                <hr class="m-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table search-table align-middle text-nowrap">
                            <thead class="header-item">
                            <th>ID</th>
                            <th>Volume Kg</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Order Id</th>
                            <td>Message</td>
                            </thead>
                            <tbody>

                            @forelse ($payment->lorawanRechargeRequests as $request)
                                <!-- start row -->
                                <tr wire:key="{{ $request->id }}" class="search-items">
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <h6>
                                                {{ Str::upper(Str::substr($request->id, 0, 10)) }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ $request->topup_to_device_amount }}</td>
                                    <td>{{ date('d M Y H:i', strtotime($request->created_at)) }}</td>
                                    <td>
                                            <span
                                                class="mb-1 badge rounded-pill  bg-{{ $request->status_color }}-subtle text-{{ $request->status_color }}">{{ $request->status }}</span>
                                    </td>
                                    <td>{{ $request->order_id ?? '-' }}</td>
                                    <td>{{ Str::substr($request->error_message, 0, 19) }}</td>
                                </tr>
                                <!-- end row -->
                            @empty
                                <tr>
                                    <td colspan="7">No recharge request was sent for this transaction.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="m-0">
                <div class="card-body">
                    <h5 class="card-title mb-0">Valve Control</h5>
                </div>
                <hr class="m-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">ID</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $payment->valveControl? Str::upper(Str::substr($payment->valveControl->id, 0, 10)):'-' }}
                            </h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Source</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $payment->valveControl? $payment->valveControl->source:'-' }}
                            </h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">State</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $payment->valveControl? $payment->valveControl->state ? 'Open valve' : 'Close valve':'-' }}
                            </h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Status</p>
                            @if($payment->valveControl)
                                <x-status-badge color="{{ $payment->valveControl->status_color }}"
                                                label="{{ $payment->valveControl->error_code == '0' ? 'Success' : 'Failed' }}"/>
                            @endif
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Value Id</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $payment->valveControl? $payment->valveControl->value_id:'-' }}
                            </h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Date</p>
                            <h6 class="fw-semibold mb-0">
                                {{ date('d M Y H:i', strtotime($request->updated_at)) }}
                            </h6>
                        </div>
                        <div class="col-12 mb-7">
                            <p class="mb-1 fs-2">Message</p>
                            <h6 class="fw-semibold mb-0">
                                {{ $payment->valveControl? $payment->valveControl->error_message:'-' }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
