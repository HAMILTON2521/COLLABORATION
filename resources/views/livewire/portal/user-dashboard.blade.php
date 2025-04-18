<div class="row">
    <div class="col-lg-4">
        <!-- ----------------------------------------- -->
        <!-- Welcome Card -->
        <!-- ----------------------------------------- -->
        <div class="card text-white bg-primary-gt overflow-hidden card-hover">
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
    <div class="col-lg-4">
        <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="card border-top border-primary card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-6 mb-4">
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-success-subtle">
                                <iconify-icon icon="solar:money-bag-bold" class="fs-7 text-success"></iconify-icon>
                            </span>
                            <h6 class="mb-0 fs-4 fw-medium">Recent Payment</h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fs-7">Tsh {{ number_format($this->recentPayment ?? 0, 0) }}</h4>
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
                <div class="card border-top border-info card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-6 mb-4">
                            <span
                                class="round-48 d-flex align-items-center justify-content-center rounded bg-info-subtle">
                                <iconify-icon icon="solar:box-linear" class="fs-7 text-info"></iconify-icon>
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
