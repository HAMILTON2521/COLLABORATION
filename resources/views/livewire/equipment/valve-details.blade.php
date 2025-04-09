<div>
    <x-page-header mainTitle="Valve Control Details" subtitle="Equipment" />
    <x-alert-status />
    <div class="card border-top border-success">
        <div class="card-body">
            <div class="row">
                <div class="col-4 mb-7">
                    <p class="mb-1 fs-2">Date executed</p>
                    <h6 class="fw-semibold mb-0">{{ date('d M Y H:i', strtotime($valveControl->created_at)) }}</h6>
                </div>
                <div class="col-4 mb-7">
                    <p class="mb-1 fs-2">Last update</p>
                    <h6 class="fw-semibold mb-0">{{ date('d M Y H:i', strtotime($valveControl->updated_at)) }}</h6>
                </div>
                <div class="col-4 mb-7">
                    <p class="mb-1 fs-2">Device EUI</p>
                    <h6 class="fw-semibold mb-0">{{ $valveControl->customer->imei }}</h6>
                </div>
                <div class="col-4 mb-7">
                    <p class="mb-1 fs-2">Executed by</p>
                    <h6 class="fw-semibold mb-0">
                        {{ isset($valveControl->user_id) ? $valveControl->user->full_name : '-' }}
                    </h6>
                </div>
                <div class="col-4 mb-7">
                    <p class="mb-1 fs-2">Command sent</p>
                    <h6 class="fw-semibold mb-0">{{ $valveControl->state ? 'Open valve' : 'Close valve' }}</h6>
                </div>
                <div class="col-4 mb-9">
                    <p class="mb-1 fs-2">Source</p>
                    <h6 class="fw-semibold mb-0">{{ $valveControl->source }}</h6>
                </div>
                @isset($valveControl->payment_id)
                    <div class="col-4 mb-9">
                        <p class="mb-1 fs-2">Payment ID</p>
                        <h6 class="fw-semibold mb-0">
                            <a
                                href="{{ route('topup.payment.details', $valveControl->payment_id) }}">{{ $valveControl->payment_id }}</a>
                        </h6>
                    </div>
                @endisset
                <div class="col-4 mb-7">
                    <p class="mb-1 fs-2">Status</p>
                    <x-status-badge color="{{ $valveControl->status_color }}"
                        label="{{ $valveControl->error_code == '0' ? 'Success' : 'Failed' }}" />
                </div>
                @isset($valveControl->value_id)
                    <div class="col-4 mb-7">
                        <p class="mb-1 fs-2">Value ID</p>
                        <h6 class="fw-semibold mb-0">{{ $valveControl->value_id }}</h6>
                    </div>
                @endisset
                <div class="col-23 mb-7">
                    <p class="mb-1 fs-2">Response message</p>
                    <h6 class="fw-semibold mb-0">{{ $valveControl->error_message ?? '-' }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<x-toast />
