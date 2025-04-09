<div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-user text-dark d-block fs-7" width="22" height="22"></i>
            </div>
            <div>
                <h5 class="fs-4 fw-semibold">Customer</h5>
                <p class="mb-0">{{ $realtime->customer->full_name }}</p>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-checkbox text-dark d-block fs-7" width="22" height="22"></i>
            </div>
            <div>
                <h5 class="fs-4 fw-semibold">Valve Status</h5>
                <p class="mb-0">{{ $realtime->valve_status }}</p>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
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
    <div class="d-flex align-items-center justify-content-between mb-4">
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
    <div class="d-flex align-items-center justify-content-between mb-4">
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
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-calendar-star text-dark d-block fs-7" width="22" height="22"></i>
            </div>
            <div>
                <h5 class="fs-4 fw-semibold">Month</h5>
                <p class="mb-0">{{ date('F Y', strtotime($realtime->month_read_time)) }}</p>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-calendar-star text-dark d-block fs-7" width="22" height="22"></i>
            </div>
            <div>
                <h5 class="fs-4 fw-semibold">Month Consumption</h5>
                <p class="mb-0">{{ $realtime->month_consumption ?? '-' }}</p>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-info-circle text-dark d-block fs-7" width="22" height="22"></i>
            </div>
            <div>
                <h5 class="fs-4 fw-semibold">Class Mode</h5>
                <p class="mb-0">{{ $realtime->class ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
