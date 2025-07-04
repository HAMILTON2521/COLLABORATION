<div>
    <x-page-header mainTitle="Equipment" subtitle="Equipment"/>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                        <path fill="none" stroke="#1195cb" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M2 12h2m16 0h2M4 12a2 2 0 1 0 4 0a2 2 0 1 0-4 0m12 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0m-8.5-1.5L15 5"/>
                    </svg>
                    <h5 class="fw-semibold fs-5 mb-2">Valve Control</h5>
                    <p class="mb-3 px-xl-5">Switch equipment valve remotely on or off.</p>
                    <a href="{{ route('more.equipment.valve') }}" type="button"
                       class="btn btn-primary">View Requests </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                        <g fill="none" stroke="#1195cb" stroke-linecap="round" stroke-linejoin="round"
                           stroke-width="2">
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 1 0-4 0m3.45-1.45L15.5 9.5"/>
                            <path d="M6.4 20a9 9 0 1 1 11.2 0z"/>
                        </g>
                    </svg>
                    <h5 class="fw-semibold fs-5 mb-2">Status Command</h5>
                    <p class="mb-3 px-xl-5">Send commands to the device to query traffic and status.</p>
                    <button wire:click="statusCommand" type="button" class="btn btn-primary">Send Command</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                        <path fill="none" stroke="#1195cb" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 7h11a2 2 0 0 1 2 2v.5a.5.5 0 0 0 .5.5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5a.5.5 0 0 0-.5.5v.5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2m1 3v4m3-4v4"/>
                    </svg>
                    <h5 class="fw-semibold fs-5 mb-2">Battery Command</h5>
                    <p class="mb-3 px-xl-5">Send a command to the device to check the battery.</p>
                    <button wire:click="batteryCommand" type="button" class="btn btn-primary">Send Command</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-info-subtle overflow-hidden shadow-none">
                <div class="card-body py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6">
                            <h5 class="fw-semibold mb-9 fs-5">Query Command Execution Result</h5>
                            <button class="btn btn-info">Click to Query</button>
                        </div>
                        <div class="col-sm-5">
                            <div class="position-relative mb-n5 text-center">
                                <img src="{{ asset('assets/images/backgrounds/track-bg.png') }}" alt="matdash-img"
                                     class="img-fluid"
                                     width="180" height="230">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
