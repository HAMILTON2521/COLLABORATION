<div>
    <x-page-header mainTitle="Meter Details" subtitle="Files" />
    @if ($file)
        <div class="card">
            <div class="card-header text-bg-primary">
                <h5 class="mb-0 text-white">Meter File Details</h5>
            </div>
            <form class="form-horizontal">
                <div class="form-body">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Customer Info</h5>
                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Name</p>
                                <h6 class="fw-semibold mb-0">{{ $file['customerName'] }}</h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Customer Serial No ID</p>
                                <h6 class="fw-semibold mb-0">{{ $file['customerSerialnumber'] }}</h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Serial No</p>
                                <h6 class="fw-semibold mb-0">{{ $file['serialnumber'] }}</h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Phone No</p>
                                <h6 class="fw-semibold mb-0">{{ $file['phone'] }}</h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">ID</p>
                                <h6 class="fw-semibold mb-0">{{ $file['id'] }}</h6>
                            </div>
                            <div class="col-4 mb-9">
                                <p class="mb-1 fs-2">Household No</p>
                                <h6 class="fw-semibold mb-0">{{ $file['householdNum'] }}</h6>
                            </div>
                        </div>

                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Device Info</h5>
                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">IMEI</p>
                                <h6 class="fw-semibold mb-0">
                                    {{ $file['deveui'] }}
                                </h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Energy Type</p>
                                <h6 class="fw-semibold mb-0">
                                    {{ $file['energyTypeName'] }}
                                </h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Readings</p>
                                <h6 class="fw-semibold mb-0">
                                    {{ $file['readings'] }}
                                </h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Valve Status</p>
                                @if ($file['valveStatus'] == 1)
                                    <iconify-icon icon="tabler:lock-open-2" width="24" height="24"
                                        class="text-success"></iconify-icon>
                                @else
                                    <iconify-icon icon="tabler:lock" width="24" height="24"
                                        class="text-danger"></iconify-icon>
                                @endif
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Balance</p>
                                <h6 class="fw-semibold mb-0">
                                    {{ number_format($file['balance'], 2) }}
                                </h6>
                            </div>
                            <div class="col-4 mb-7">
                                <p class="mb-1 fs-2">Price Name</p>
                                <h6 class="fw-semibold mb-0">
                                    {{ $file['priceName'] }}
                                </h6>
                                <div class="col-4 mb-7">
                                    <p class="mb-1 fs-2">Flat Price</p>
                                    <h6 class="fw-semibold mb-0">
                                        {{ $file['flatPrice'] }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    @else
        <div id="alert" class="alert alert-success text-success" role="alert">
            Failed to fetch file details
        </div>
    @endif

</div>
