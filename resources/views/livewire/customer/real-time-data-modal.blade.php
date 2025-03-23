<div>
    <!-- Vertically centered modal -->
    <div class="modal fade" id="realtimeDataModal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            @isset($realtime)
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-success text-white d-flex align-items-center">
                        <h4 class="modal-title text-white" id="myLargeModalLabel">
                            Device {{ $realtime->imei }}
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
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
                                    <div
                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
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
                                    <div
                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-report-money text-dark d-block fs-7" width="22"
                                            height="22"></i>
                                    </div>
                                    <div>
                                        <h5 class="fs-4 fw-semibold">Balance</h5>
                                        <p class="mb-0">{{ number_format($realtime->balance, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
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
                                    <div
                                        class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-calendar-star text-dark d-block fs-7" width="22"
                                            height="22"></i>
                                    </div>
                                    <div>
                                        <h5 class="fs-4 fw-semibold">Daily Consumption</h5>
                                        <p class="mb-0">{{ $realtime->day_consumption }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger-subtle text-danger  waves-effect text-start"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('showRealtimeDataModal', (event) => {
            $("#realtimeDataModal").modal('show');
        });
    </script>
@endscript
