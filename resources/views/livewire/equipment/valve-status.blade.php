<div>
    <div class="row">
        <div class="col-12 mb-7">
            <p class="mb-1 fs-2">IMEI</p>
            <h6 class="fw-semibold mb-0">
                {{ $response['data']['nbonetNetImei'] }}
            </h6>
        </div>
        <div class="col-12 mb-7">
            <p class="mb-1 fs-2">Valve Status</p>
            <h6 class="fw-semibold mb-0">
                {{ strtoupper($response['data']['valveStatus']) }}
            </h6>
        </div>
    </div>
</div>
