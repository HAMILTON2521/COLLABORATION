<div>
    <x-page-header mainTitle="SMS Settings" subtitle="Settings" />
    <div class="card border-top border-success">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'sms')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'sms' ? 'active' : '' }}"
                    id="pills-sms-tab" data-bs-toggle="pill" data-bs-target="#pills-sms" type="button" role="tab"
                    aria-controls="pills-sms" aria-selected="false">
                    <i class="ti ti-message-cog me-2 fs-6"></i>
                    <span class="d-none d-md-block">Settings</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'templates')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'templates' ? 'active' : '' }}"
                    id="pills-templates-tab" data-bs-toggle="pill" data-bs-target="#pills-templates" type="button"
                    role="tab" aria-controls="pills-templates" aria-selected="true">
                    <i class="ti ti-message-2-share me-2 fs-6"></i>
                    <span class="d-none d-md-block">Templates</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'activity')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'activity' ? 'active' : '' }}"
                    id="pills-activity-tab" data-bs-toggle="pill" data-bs-target="#pills-activity" type="button"
                    role="tab" aria-controls="pills-activity" aria-selected="true">
                    <i class="ti ti-message-forward me-2 fs-6"></i>
                    <span class="d-none d-md-block">Message Activities</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'actions')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'actions' ? 'active' : '' }}"
                    id="pills-actions-tab" data-bs-toggle="pill" data-bs-target="#pills-actions" type="button"
                    role="tab" aria-controls="pills-actions" aria-selected="true">
                    <i class="ti ti-click me-2 fs-6"></i>
                    <span class="d-none d-md-block">Actions</span>
                </button>
            </li>

        </ul>
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade {{ $activeTab === 'sms' ? 'show active' : '' }}" id="pills-sms"
                    role="tabpanel" aria-labelledby="pills-sms-tab" tabindex="0">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title mb-0">SMS Settings</h4>
                    </div>
                    @include('livewire.settings.sms.index')
                </div>
                <div class="tab-pane fade {{ $activeTab === 'templates' ? 'show active' : '' }}" id="pills-templates"
                    role="tabpanel" aria-labelledby="pills-templates-tab" tabindex="0">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title mb-0">Message Templates</h4>
                    </div>
                    @include('livewire.settings.sms.templates')
                </div>
                <div class="tab-pane fade {{ $activeTab === 'activity' ? 'show active' : '' }}" id="pills-activity"
                    role="tabpanel" aria-labelledby="pills-activity-tab" tabindex="0">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title mb-0">Map Activities with Message Tamplate</h4>
                    </div>
                    @include('livewire.settings.sms.activities')
                </div>
                <div class="tab-pane fade {{ $activeTab === 'actions' ? 'show active' : '' }}" id="pills-actions"
                    role="tabpanel" aria-labelledby="pills-actions-tab" tabindex="0">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title mb-0">Actions</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-lg">
                                <div class="card-header">SMS Balance</div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Check remaining SMS balance.
                                    </p>
                                    <button type="button" wire:click="checkSmsBalance"
                                        class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                                        <i class="ti ti-message-forward fs-4 me-2"></i>
                                        Check <x-spinner target="checkSmsBalance" />
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-lg">
                                <div class="card-header">Test SMS</div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Send a test message.
                                    </p>
                                    <button type="button" wire:click="openTestSmsModal"
                                        class="justify-content-center btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                                        <i class="ti ti-send fs-4 me-2"></i>
                                        Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('utils.custom-modal')
</div>
<x-modal />
