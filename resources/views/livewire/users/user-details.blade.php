<div>
    <x-page-header mainTitle="User Details" subtitle="Users" />

    <div class="card">
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'profile')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'profile' ? 'active' : '' }}"
                    id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button"
                    role="tab" aria-controls="pills-account" aria-selected="true">
                    <i class="ti ti-user-circle me-2 fs-6"></i>
                    <span class="d-none d-md-block">Profile</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'accounts')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 {{ $activeTab === 'accounts' ? 'active' : '' }}"
                    id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button"
                    role="tab" aria-controls="pills-bills" aria-selected="false">
                    <i class="ti ti-article me-2 fs-6"></i>
                    <span class="d-none d-md-block">Accounts</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button wire:click="$set('activeTab', 'payments')"
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3  {{ $activeTab === 'payments' ? 'active' : '' }}"
                    id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button"
                    role="tab" aria-controls="pills-security" aria-selected="false">
                    <i class="ti ti-report-money me-2 fs-6"></i>
                    <span class="d-none d-md-block">Payments</span>
                </button>
            </li>
        </ul>
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade {{ $activeTab === 'profile' ? 'show active' : '' }}" id="pills-account"
                    role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-top border-success position-relative overflow-hidden mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex mb-4 align-items-center">
                                        <h4 class="card-title">
                                            <x-status-badge color="{{ $user->is_active_color }}"
                                                label="{{ $user->is_active_label }}" />
                                        </h4>
                                        <div class="ms-auto">
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn bg-primary-subtle text-primary  dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button wire:click="edit" type="button"
                                                        class="dropdown-item">Edit</button>

                                                    <button wire:click="changeActiveStatus" type="button"
                                                        class="dropdown-item">{{ $user->is_active ? 'Deactivate' : 'Activate' }}</button>

                                                    <button wire:click="userAccounts" type="button"
                                                        class="dropdown-item">Accounts</button>
                                                    <button wire:click="assignAccount" type="button"
                                                        class="dropdown-item">Assign
                                                        Account</button>
                                                    <div class="dropdown-divider"></div>
                                                    <button wire:confirm="Delete user {{ $user->full_name }}?"
                                                        wire:click="delete" type="button"
                                                        class="dropdown-item">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <x-input class="form-control" name="first_name" disabled
                                                    value="{{ $user->first_name }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <x-input class="form-control" name="last_name" disabled
                                                    value="{{ $user->last_name }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <x-input disabled class="form-control" name="email"
                                                    value="{{ $user->email }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <x-input maxlength="10" class="form-control" name="phone" disabled
                                                    value="{{ $user->phone }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">User Type</label>
                                                <x-input maxlength="10" class="form-control" name="user_type"
                                                    disabled value="{{ $user->user_type }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab === 'accounts' ? 'show active' : '' }}" id="pills-bills"
                    role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-top border-success">
                                <div class="card-body p-4">
                                    <div class="d-flex  align-items-center mb-3">
                                        <h4 class="card-title mb-0">Accounts</h4>
                                        <div class="ms-auto">
                                            <a href="{{ route('more.users.assign', $user->id) }}" wire:navigate
                                                id="btn-add-user" class="btn btn-primary d-flex align-items-center">
                                                <i class="ti ti-user-plus text-white me-1 fs-5"></i> Add More
                                            </a>
                                        </div>
                                    </div>
                                    <x-user-accounts-table :accounts="$this->accounts" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $activeTab === 'payments' ? 'show active' : '' }}" id="pills-security"
                    role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                    <div class="row">
                        <div class="col-lg-8">
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
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div
                                        class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                        <i class="ti ti-device-laptop text-primary d-block fs-7" width="22"
                                            height="22"></i>
                                    </div>
                                    <h4 class="card-title mb-0">Devices</h4>
                                    <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
                                    <button class="btn btn-primary mb-4">Sign out from all devices</button>
                                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="ti ti-device-mobile text-dark d-block fs-7" width="26"
                                                height="26"></i>
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                                                <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                                            </div>
                                        </div>
                                        <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="ti ti-device-laptop text-dark d-block fs-7" width="26"
                                                height="26"></i>
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                                                <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                                            </div>
                                        </div>
                                        <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)">
                                            <i class="ti ti-dots-vertical"></i>
                                        </a>
                                    </div>
                                    <button class="btn bg-primary-subtle text-primary w-100 py-1">Need Help ?</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end gap-6">
                                <button class="btn btn-primary">Save</button>
                                <button class="btn bg-danger-subtle text-danger">Cancel</button>
                            </div>
                        </div>
                    </div><x-toast />
                </div>
            </div>
        </div>
    </div>

</div>
