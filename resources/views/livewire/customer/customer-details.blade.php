<div>
    <x-page-header mainTitle="Customer Details" subtitle="Customers" />
    <div class="card border-top border-success">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div
                                class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="ti ti-device-watch text-primary d-block fs-7" width="22"
                                    height="22"></i>
                            </div>
                            <h4 class="card-title mb-0">{{ $customer->imei }}</h4>
                            <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
                            <button type="button" wire:click="checkBalance" class="btn btn-success mb-4">Check
                                Balance</button>
                            <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="ti ti-user text-dark d-block fs-7" width="26" height="26"></i>
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">{{ $customer->full_name }}</h5>
                                        <p class="mb-0">{{ $customer->phone }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="ti ti-dashboard text-dark d-block fs-7" width="26" height="26"></i>
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">Account</h5>
                                        <p class="mb-0">{{ $customer->ref }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="ti ti-location text-dark d-block fs-7" width="26" height="26"></i>
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">{{ $customer->region->name }}</h5>
                                        <p class="mb-0">{{ $customer->district->name }}</p>
                                    </div>
                                </div>
                                <a wire:navigate
                                    class="text-primary fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                    href="{{ route('customers.region', $customer->region_id) }}">
                                    <i class="ti ti-info-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card border shadow-none">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Query real time data</h5>
                                </div>
                                <button type="button" wire:click="queryRealTimeData"
                                    class="btn bg-primary-subtle text-primary">Start <span wire:loading
                                        wire:target="queryRealTimeData" class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true"></span></button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Get daily settlement records</h5>
                                </div>
                                <button class="btn bg-primary-subtle text-primary">Start</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Get monthly settlement records</h5>
                                </div>
                                <button class="btn bg-primary-subtle text-primary">Start</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Edit meter file</h5>
                                </div>
                                <button class="btn bg-primary-subtle text-primary">Start</button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Recharge Meter</h5>
                                </div>
                                <button class="btn bg-primary-subtle text-primary">Start</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-end gap-6">
                        <button wire:click="editCustomer" type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn bg-danger-subtle text-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('customer.real-time-data-modal')
</div>
