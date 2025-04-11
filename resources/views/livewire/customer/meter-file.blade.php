<div>
    <div class="row">
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">ID</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['id'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Customer Name</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['customerName'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Customer Serial No</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['customerSerialnumber'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Serial Number</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['serialnumber'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">IMEI</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['deveui'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Energy Type</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['energyTypeName'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Readings</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['readings'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">balance</p>
            <h6 class="fw-semibold mb-0">
                {{ number_format($meter['value']['balance'], 2) }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Valve Status</p>
            <h6 class="fw-semibold mb-0">
                @if ($meter['value']['valveStatus'] === 1)
                    <iconify-icon icon="tabler:lock-open-2" width="24" height="24"
                        class="text-success"></iconify-icon>
                @else
                    <iconify-icon icon="tabler:lock" width="24" height="24" class="text-danger"></iconify-icon>
                @endif
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Phone</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['phone'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Household Number</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['householdNum'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Price Plan Name</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['priceInfo']['priceName'] }}
            </h6>
        </div>
        <div class="col-4 mb-7">
            <p class="mb-1 fs-2">Flat Price/Unit Price</p>
            <h6 class="fw-semibold mb-0">
                {{ $meter['value']['priceInfo']['flatPrice'] }}
            </h6>
        </div>
    </div>
</div>
