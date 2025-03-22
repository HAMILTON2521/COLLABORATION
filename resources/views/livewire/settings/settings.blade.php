<div>
    <x-page-header mainTitle="System Settings" subtitle="Settings" />
    <div class="card border-top border-success">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'system')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'system' ? 'active' : '' }}"
                    id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button"
                    role="tab" aria-controls="pills-security" aria-selected="false">
                    <i class="ti ti-lock me-2 fs-6"></i>
                    <span class="d-none d-md-block">System Settings</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'account')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'account' ? 'active' : '' }}"
                    id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button"
                    role="tab" aria-controls="pills-account" aria-selected="true">
                    <i class="ti ti-settings-plus me-2 fs-6"></i>
                    <span class="d-none d-md-block">Billing</span>
                </button>
            </li>

        </ul>
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade {{ $activeTab === 'system' ? 'show active' : '' }}" id="pills-security"
                    role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border shadow-none">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-3">Two-factor Authentication</h4>
                                    <div class="d-flex align-items-center justify-content-between pb-7">
                                        <p class="card-subtitle mb-0">Lorem ipsum, dolor sit amet consectetur
                                            adipisicing
                                            elit. Corporis sapiente
                                            sunt earum officiis laboriosam ut.</p>
                                        <button class="btn btn-primary">Enable</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                            <p class="mb-0">Google auth app</p>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary">Setup</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                            <p class="mb-0">E-mail to send verification link</p>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary">Setup</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                            <p class="mb-0">Your phone number or something</p>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary">Setup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab === 'account' ? 'show active' : '' }}" id="pills-account"
                    role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border shadow-none">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-3">Two-factor Authentication</h4>
                                    <div class="d-flex align-items-center justify-content-between pb-7">
                                        <p class="card-subtitle mb-0">Lorem ipsum, dolor sit amet consectetur
                                            adipisicing
                                            elit. Corporis sapiente
                                            sunt earum officiis laboriosam ut.</p>
                                        <button class="btn btn-primary">Enable</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                            <p class="mb-0">Google auth app</p>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary">Setup</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                            <p class="mb-0">E-mail to send verification link</p>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary">Setup</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                        <div>
                                            <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                            <p class="mb-0">Your phone number or something</p>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary">Setup</button>
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
