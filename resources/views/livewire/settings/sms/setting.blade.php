<div>
    <div class="row">
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-info-circle text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Key</h5>
                        <p class="mb-0">{{ $setting->key }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-info-square text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Type</h5>
                        <p class="mb-0">{{ $setting->type }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-info-circle-filled text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Value</h5>
                        <p class="mb-0">{{ $setting->value }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-calendar-time text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Last Updated</h5>
                        <p class="mb-0">{{ $setting->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-message text-dark d-block fs-7" width="22" height="22"></i>
                    </div>
                    <div>
                        <h5 class="fs-4 fw-semibold">Description</h5>
                        <p class="mb-0">{{ $setting->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
