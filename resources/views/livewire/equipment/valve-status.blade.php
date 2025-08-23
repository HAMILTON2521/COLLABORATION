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
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold mb-0">
                    {{ ucfirst($response['data']['valveStatus']) }}
                </h6>
                @if ($response['data']['valveStatus'] === 'open')
                    <iconify-icon icon="tabler:lock-open-2" width="24" height="24"
                                  class="text-success"></iconify-icon>
                @else
                    <iconify-icon icon="tabler:lock" width="24" height="24" class="text-danger"></iconify-icon>
                @endif
            </div>
        </div>
    </div>
</div>
