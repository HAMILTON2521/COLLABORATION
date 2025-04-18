<div>
    <x-page-header mainTitle="Data Query" subtitle="Data" />
    <div class="card border-top border-success">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border shadow-none">
                        <div class="card-body p-4">
                            <div class="d-flex bg-hover-light-black align-items-center justify-content-between pb-3">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Query real time data</h5>
                                </div>
                                <a href="{{ route('more.data.device.data') }}" wire:navigate
                                    class="btn bg-primary-subtle text-primary">Start
                                </a>
                            </div>
                            <div
                                class="d-flex bg-hover-light-black align-items-center justify-content-between pb-3 border-top">
                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">Query real time data</h5>
                                </div>
                                <button type="button" wire:click="queryRealTimeData"
                                    class="btn bg-primary-subtle text-primary">Start <span wire:loading=""
                                        wire:target="queryRealTimeData" class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
