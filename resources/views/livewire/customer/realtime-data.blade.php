<div>
    <div class="row">
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-clock text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Read Time</h5>
                        <p class="mb-0">{{ date('d M Y H:i',strtotime($realtime->read_time)) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-info-circle-filled text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Margin</h5>
                        <p class="mb-0">{{ $realtime->margin }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-user text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Customer</h5>
                        <p class="mb-0">{{ $realtime->customer_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-location text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Customer Address</h5>
                        <p class="mb-0">{{ $realtime->customer_address ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-checkbox text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Valve Status</h5>
                        <p class="mb-0">{{ $realtime->valve_state?'Open':'Closed' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-report-money text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Balance</h5>
                        <p class="mb-0">
                            @isset($realtime->balance)
                                {{ number_format($realtime->balance, 2) }}
                            @endisset
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-dashboard text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Reading</h5>
                        <p class="mb-0">{{ $realtime->reading }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-calendar-star text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Day Consumption</h5>
                        <p class="mb-0">{{ $realtime->day_consumption }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-gauge text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Remaining Flow</h5>
                        <p class="mb-0">{{ $realtime->remaining_flow }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-battery text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Battery</h5>
                        <p class="mb-0">{{ $realtime->battery }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-map-2 text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">GPS Latitude</h5>
                        <p class="mb-0">{{ $realtime->latitude }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-map text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">GPS Longitude</h5>
                        <p class="mb-0">{{ $realtime->longitude }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
