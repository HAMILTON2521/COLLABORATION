<div class="row">
    <div class="col-lg-6">
        <!-- ----------------------------------------- -->
        <!-- Welcome Card -->
        <!-- ----------------------------------------- -->
        <div class="card text-white bg-primary-gt overflow-hidden">
            <div class="card-body position-relative z-1">
                <span class="badge badge-custom-dark d-inline-flex align-items-center gap-2 fs-3">
                    <iconify-icon icon="solar:calendar-outline" class="fs-5"></iconify-icon>
                    <span class="fw-normal">{{ date('d') }} <span class="fw-semibold">
                            {{ date('M Y') }}
                        </span>
                    </span>
                </span>
                <h4 class="text-white fw-normal mt-5 pt-7 mb-1">Hey, <span class="fw-bolder">
                        {{ Auth::user()->full_name }}
                    </span>
                </h4>
                <h6 class="opacity-75 fw-normal text-white mb-0">
                    {{ Auth::user()->email }}
                    </span>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <!-- ----------------------------------------- -->
                <!-- Subscriptions -->
                <!-- ----------------------------------------- -->
                <div class="card bg-danger-subtle overflow-hidden shadow-none">
                    <div class="card-body px-4">
                        <div class="d-flex align-items-center justify-content-between mb-8">
                            <div>
                                <span class="text-dark-light fw-semibold fs-12">Subscriptions</span>
                                <div class="hstack gap-2">
                                    <h5 class="card-title fw-semibold mb-0 fs-7">78,298</h5>
                                    <span class="fs-11 text-dark-light fw-semibold">-12%</span>
                                </div>
                            </div>
                            <span class="round-48 d-flex align-items-center justify-content-center bg-white rounded">
                                <iconify-icon icon="solar:layers-linear" class="text-danger fs-6"></iconify-icon>
                            </span>
                        </div>
                        <div class="me-n2">
                            <div id="subscriptions" class="rounded-bars"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <!-- ----------------------------------------- -->
                <!-- Users -->
                <!-- ----------------------------------------- -->
                <div class="card bg-secondary-subtle overflow-hidden shadow-none">
                    <div class="card-body px-4">
                        <div class="d-flex align-items-center justify-content-between mb-9">
                            <div>
                                <span class="text-dark-light fw-semibold">Users</span>
                                <div class="hstack gap-2">
                                    <h5 class="card-title fw-semibold mb-0 fs-7">14,872</h5>
                                    <span class="fs-11 text-dark-light fw-semibold">+6.4%</span>
                                </div>
                            </div>
                            <span class="round-48 d-flex align-items-center justify-content-center bg-white rounded">
                                <iconify-icon icon="solar:pie-chart-3-line-duotone"
                                    class="text-secondary fs-6"></iconify-icon>
                            </span>
                        </div>


                    </div>
                    <div id="users"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-6 mb-4">
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                                <iconify-icon icon="solar:box-linear" class="fs-7 text-danger"></iconify-icon>
                            </span>
                            <h6 class="mb-0 fs-4 fw-medium">Total Payments</h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fs-7">Tsh {{ number_format($this->total->total_amount ?? 0, 0) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-6 mb-4 pb-9">
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                                <iconify-icon icon="solar:football-outline" class="fs-7 text-secondary">
                                </iconify-icon>
                            </span>
                            <h6 class="mb-0 fs-4 fw-medium">New Customers</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <h6 class="mb-0 fw-medium">New goals</h6>
                            <h6 class="mb-0 fw-medium">83%</h6>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-secondary" style="width: 83%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------- -->
    <!-- Recent Payments -->
    <!-- ----------------------------------------- -->
    <x-recent-payments :payments="$this->payments" />

</div>

@push('js')
    <script src="{{ asset('assets/js/extra-libs/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/extra-libs/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard2.js') }}"></script>
@endpush
