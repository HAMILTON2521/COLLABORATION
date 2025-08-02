<div>
    <x-page-header mainTitle="Buy Gas" subtitle="Account" />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-top border-primary card-hover">
                        <div class="card-body">
                            <h4 class="card-title mb-3">SELCOM</h4>
                            <div class="ms-2 me-auto">
                                <div class="mb-3">
                                    Enter your phone number and amount. A PIN request
                                    will be sent to your phone for confirmation.
                                </div>
                                <a href="{{ route('portal.account.buy.selcom', $customer->id) }}"
                                    class="btn btn-primary">
                                    Pay Now
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-top border-danger card-hover">
                        <div class="card-body">
                            <h4 class="card-title mb-3">AIRTEL MONEY</h4>
                            <div class="ms-2 me-auto">
                                <div class="mb-3">
                                    Enter your Airtel Money number and amount. A PIN request
                                    will be sent to your phone for confirmation.
                                </div>
                                {{-- <button
                                    wire:click="$dispatch('openModal', {component: 'portal.buy-gas-form',arguments:{customer:'{{ $customer->id }}'} })"
                                    type="button" class="btn btn-primary">
                                    Pay
                                </button> --}}

                                <a href="{{ route('portal.account.buy.airtel', $customer->id) }}"
                                    class="btn btn-primary">
                                    Pay Now
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100 border-top border-info">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Mobile Payment using *150*</h4>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Airtel Money
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                            skateboard dolor brunch.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Mpesa
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                            skateboard dolor brunch.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Mixx by Yas
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                            skateboard dolor brunch.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
