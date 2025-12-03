<div>
    <x-page-header mainTitle="Customer Details" subtitle="Customers"/>
    <div class="card border-top border-success">
        <form class="form-horizontal">
            <div class="form-body">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Customer Info</h5>
                        <a href="{{ route('customers.edit', $customer->id) }}" wire:click="editCustomer"
                           class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <hr class="m-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Name</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->full_name }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Phone Number</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->phone }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">Region</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->region->name }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">District</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->district->name }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Ward</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->ward??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Street</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->street??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-7">
                            <p class="mb-1 fs-2">IMEI Number</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->imei }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Account</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->ref }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Occupation</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->occupation??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Cooks Per Day</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->cooks_per_day??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Family Size</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->family_size??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">House Number</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->house_number??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Previous Energy Source</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->current_energy_source??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Created By</p>
                            <h6 class="fw-semibold mb-0">{{ $customer->creator->full_name??'-' }}</h6>
                        </div>
                        <div class="col-4 mb-9">
                            <p class="mb-1 fs-2">Joined On</p>
                            <h6 class="fw-semibold mb-0">{{ date('d M Y H:i',strtotime($customer->created_at)) }}</h6>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="card border-top border-success">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
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
                                    <h5 class="fs-4 fw-semibold mb-0">Valve status</h5>
                                </div>
                                <button wire:click="getValveStatus" type="button"
                                        class="btn bg-primary-subtle text-primary">Start
                                    <x-spinner target="getValveStatus"/>
                                </button>
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
            </div>
        </div>
    </div>
    @livewire('utils.custom-modal')
</div>
<x-modal/>
