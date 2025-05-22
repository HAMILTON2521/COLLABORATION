<div>
    <x-page-header mainTitle="General Settings" subtitle="Settings" />
    <div class="card border-top border-success">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'system')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'system' ? 'active' : '' }}"
                    id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button"
                    role="tab" aria-controls="pills-security" aria-selected="false">
                    <i class="ti ti-lock me-2 fs-6"></i>
                    <span class="d-none d-md-block">Settings</span>
                </button>
            </li>
        </ul>
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade {{ $activeTab === 'system' ? 'show active' : '' }}" id="pills-security"
                    role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title mb-0">System Settings</h4>
                        <button type="button"
                            wire:click="$dispatch('showModal', {data:{alias:'settings.create','size' :'modal-md'}})"
                            class="btn btn-primary hstack gap-6">
                            <i class="ti ti-plus fs-4"></i>
                            Add New
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border shadow-none">
                                <div class="card-body p-4">
                                    @forelse ($this->settings as $setting)
                                        <div wire:key="{{ $setting->id }}"
                                            class="d-flex mb-2 bg-hover-light-black align-items-center justify-content-between p-3 border-bottom border-rounded rounded">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">
                                                    {{ $setting->key }}</h5>
                                                <p class="mb-0">{{ $setting->value }}</p>
                                            </div>

                                            <ul class="list-unstyled mb-0 d-flex align-items-center">
                                                <li class="position-relative" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="View">
                                                    <a class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                                        href="javascript:;"
                                                        wire:click="$dispatch('showModal', {data:{alias:'settings.setting','size' :'modal-md', params:{setting: '{{ $setting->id }}'}}})">
                                                        <i class="ti ti-info-circle"></i>
                                                    </a>
                                                </li>
                                                @if ($setting->editable)
                                                    <li class="position-relative" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Edit">
                                                        <a class="d-block text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                                            href="javascript:;"
                                                            wire:click="$dispatch('showModal', {data:{alias:'settings.edit','size' :'modal-md', params:{setting: '{{ $setting->id }}'}}})">
                                                            <i class="ti ti-pencil"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @empty
                                        <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
                                            role="alert">
                                            <span class="side-line bg-success"></span>

                                            <div class="d-flex align-items-center ">
                                                <i class="ti ti-info-circle fs-5 text-secondary me-2 flex-shrink-0"></i>
                                                <span class="text-truncate">No settings data available.</span>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-toast />
