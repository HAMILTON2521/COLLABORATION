<div>
    <x-page-header mainTitle="Customer Details" subtitle="Customers"/>
    <div class="card border-top border-success">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div
                                class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between flex-wrap gap-6">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $customer->profile_photo }}" alt="user8" width="48" height="48"
                                         class="rounded-circle">
                                    <div>
                                        <h6 class="fw-semibold mb-0">
                                            {{ $customer->first_name }}
                                        </h6>
                                        <p class="mb-0">
                                            {{ $customer->last_name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="ti ti-info-circle text-dark d-block fs-7" width="26"
                                       height="26"></i>
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">IMEI Number</h5>
                                        <p class="mb-0">{{ $customer->imei }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="ti ti-dashboard text-dark d-block fs-7" width="26" height="26"></i>
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">Account</h5>
                                        <p class="mb-0">{{ $customer->ref }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="ti ti-location text-dark d-block fs-7" width="26" height="26"></i>
                                    <div>
                                        <h5 class="fs-4 fw-semibold mb-0">{{ $customer->region->name }}</h5>
                                        <p class="mb-0">{{ $customer->district->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card border shadow-none">
                        <div class="card-body p-4">
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Query real time data</h5>
                                </div>
                                <button type="button" wire:click="queryRealTimeData"
                                        class="btn bg-primary-subtle text-primary">Start
                                    <x-spinner target="queryRealTimeData"/>
                                </button>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Get daily settlement records</h5>
                                </div>
                                <button type="button" wire:click="dailySettlementRecords"
                                        class="btn bg-primary-subtle text-primary">Start
                                    <x-spinner target="dailySettlementRecords"/>
                                </button>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Get monthly settlement records</h5>
                                </div>
                                <button type="button" wire:click="monthlySettlementRecords"
                                        class="btn bg-primary-subtle text-primary">Start
                                    <x-spinner target="monthlySettlementRecords"/>
                                </button>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Get meter file details</h5>
                                </div>
                                <button wire:click="getMeterFile" type="button"
                                        class="btn bg-primary-subtle text-primary">Start
                                    <x-spinner target="getMeterFile"/>
                                </button>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Edit meter file</h5>
                                </div>
                                <button type="button" class="btn bg-primary-subtle text-primary">Start</button>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Recharge meter</h5>
                                </div>
                                <a href="{{ route('topup.payment.recharge', $customer->id) }}"
                                   class="btn bg-primary-subtle text-primary">Start</a>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Valve control records</h5>
                                </div>
                                <a href="{{ route('more.equipment.valve.control', $customer->id) }}"
                                   class="btn bg-primary-subtle text-primary">Start </a>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Open valve</h5>
                                </div>
                                @livewire('equipment.open-valve', ['customer' => $customer])
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between p-2 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Close valve</h5>
                                </div>
                                @livewire('equipment.close-valve', ['customer' => $customer])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-end gap-6">
                        <a href="{{ route('customers.edit', $customer->id) }}" wire:click="editCustomer"
                           class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('utils.custom-modal')
</div>
<x-modal/>
