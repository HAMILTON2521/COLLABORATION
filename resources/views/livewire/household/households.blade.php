<div>
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Accounts</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <x-dashboard-link />
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Accounts
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <form class="position-relative">
                        <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search Contacts..." />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
                <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <div class="action-btn show-btn">
                        <a href="javascript:void(0)" class="delete-multiple bg-danger-subtle btn me-2 text-danger d-flex align-items-center ">
                            <i class="ti ti-trash me-1 fs-5"></i> Delete All Row
                        </a>
                    </div>
                    <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-users text-white me-1 fs-5"></i> Add Contact
                    </a>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <x-form wire:submit="save" autocomplete="off">
                        <div class="modal-header d-flex align-items-center">
                            <h5 class="modal-title">Household</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="add-contact-box">
                                <div class="add-contact-content">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input
                                                    wire:model="form.name"
                                                    name="name"
                                                    class="form-control {{ $errors->has('form.name') ? 'is-invalid' : '' }}"
                                                    placeholder="Name" />
                                                @error('form.name')
                                                <span class="validation-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input
                                                    wire:model="form.warn_money"
                                                    type="number"
                                                    name="warn_money"
                                                    class="form-control {{ $errors->has('form.warn_money') ? 'is-invalid' : '' }}"
                                                    placeholder="Warn money" />
                                                @error('form.warn_money')
                                                <span class="validation-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input
                                                    wire:model="form.fee"
                                                    type="number"
                                                    name="fee"
                                                    class="form-control {{ $errors->has('form.fee') ? 'is-invalid' : '' }}"
                                                    placeholder="Household Fee" />
                                                @error('form.fee')
                                                <span class="validation-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                                <x-input
                                                    wire:model="form.phone"
                                                    maxlength="10"
                                                    name="phone"
                                                    class="form-control {{ $errors->has('form.phone') ? 'is-invalid' : '' }}"
                                                    placeholder="Phone" />
                                                @error('form.phone')
                                                <span class="validation-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-input
                                                    wire:model="form.address"
                                                    name="address"
                                                    class="form-control {{ $errors->has('form.address') ? 'is-invalid' : '' }}"
                                                    placeholder="Address" />
                                                @error('form.address')
                                                <span class="validation-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex gap-6 m-0">
                                <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Discard </button>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>

                        </div>
                    </x-form>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                        <th>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input primary" id="contact-check-all" />
                                    <label class="form-check-label" for="contact-check-all"></label>
                                    <span class="new-control-indicator"></span>
                                </div>
                            </div>
                        </th>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Address</th>
                        <th>Fee</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if ($status!=200)
                        <tr>
                            <td colspan="7">Error in fetching households.</td>
                        </tr>
                        @else
                        @foreach ($accounts as $account)
                        <!-- start row -->
                        <tr wire:key="{{ $account['id'] }}" class="search-items">
                            <td>
                                <div class="n-chk align-self-center text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox1" />
                                        <label class="form-check-label" for="checkbox1"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="avatar" class="rounded-circle" width="35" />
                                    <div class="ms-3">
                                        <div class="user-meta-info">
                                            <h6 class="household-name mb-0" data-name="{{ $account['householdName'] }}">{{ $account['householdName'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="usr-email-addr" data-serialnumber="{{ $account['serialnumber'] }}">{{ $account['serialnumber'] }}</span>
                            </td>
                            <td>
                                <span class="household-address" data-address="{{ $account['householdAddress'] }}">{{ $account['householdAddress'] }}</span>
                            </td>
                            <td>
                                <span class="household-fee" data-fee="{{ $account['householdFee'] }}">{{ $account['householdFee'] }}</span>
                            </td>
                            <td>
                                <span class="household-phone" data-phone="{{ $account['phone']??'-' }}">{{ $account['phone']??'-' }}</span>
                            </td>
                            <td>
                                <div class="action-btn">
                                    <a href="javascript:void(0)" class="text-primary edit">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="text-dark delete ms-2">
                                        <i class="ti ti-trash fs-5"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <!-- end row -->
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets/libs/fullcalendar/index.global.min.js') }}"></script>
<script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush