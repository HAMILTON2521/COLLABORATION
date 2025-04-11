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
                    <span class="d-none d-md-block">Add new</span>
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
                                    @forelse ($this->settings as $setting)
                                        <div wire:key="{{ $setting->id }}"
                                            class="d-flex bg-hover-light-black align-items-center justify-content-between py-3 border-bottom">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">
                                                    {{ Str::replace('_', ' ', $setting->key) }}</h5>
                                                <p class="mb-0">{{ $setting->value }}</p>
                                            </div>

                                            <ul class="list-unstyled mb-0 d-flex align-items-center">
                                                <li class="position-relative" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="View">
                                                    <a class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                                        href="javascript:;">
                                                        <i class="ti ti-info-circle"></i>
                                                    </a>
                                                </li>
                                                <li class="position-relative" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Edit">
                                                    <a class="d-block text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                                        href="javascript:;">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                </li>
                                                <li class="position-relative" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Delete">
                                                    <button type="button" wire:confirm="Delete {{ $setting->key }}?"
                                                        wire:click="delete('{{ $setting->id }}')"
                                                        class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5 btn btn-sm border-0">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </li>
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
                <div class="tab-pane fade {{ $activeTab === 'account' ? 'show active' : '' }}" id="pills-account"
                    role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                    <div class="row">
                        <form wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.key" type="text" class="form-control" id="key"
                                            placeholder="Enter key">
                                        <label for="key">Key <span class="text-danger">*</span></label>
                                        @error('form.key')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.value" type="text" class="form-control"
                                            id="value" placeholder="Enter value">
                                        <label for="value">Value <span class="text-danger">*</span></label>
                                        @error('form.value')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.type" type="text" class="form-control"
                                            id="type" placeholder="Type">
                                        <label for="type">Type e.g string, integer <span
                                                class="text-danger">*</span></label>
                                        @error('form.type')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input wire:model="form.description" type="text" class="form-control"
                                            id="desc" placeholder="Description">
                                        <label for="desc">Description</label>
                                        @error('form.description')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-md-flex align-items-center">
                                        <div class="form-check">
                                        </div>
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <button type="submit" class="btn btn-primary hstack gap-6">
                                                <i class="ti ti-send fs-4"></i>
                                                Submit <span wire:loading wire:target="save"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-toast />
