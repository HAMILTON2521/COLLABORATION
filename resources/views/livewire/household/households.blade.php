<div>
    <x-page-header mainTitle="Households" subtitle="Households" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <form class="position-relative">
                        <input type="text" class="form-control product-search ps-5" id="input-search"
                            placeholder="Search Contacts..." />
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
                <div
                    class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <div class="action-btn show-btn">
                        <a href="javascript:void(0)"
                            class="delete-multiple bg-danger-subtle btn me-2 text-danger d-flex align-items-center ">
                            <i class="ti ti-trash me-1 fs-5"></i> Delete All Row
                        </a>
                    </div>
                    <a href="{{ route('households.create') }}" wire:navigate id="btn-add-contact"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-users text-white me-1 fs-5"></i> Add Household
                    </a>
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

                        @forelse ($this->accounts as $account)
                            <!-- start row -->
                            <tr wire:key="{{ $account->id }}" class="search-items">
                                <td>
                                    <div class="n-chk align-self-center text-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input contact-chkbox primary"
                                                id="checkbox1" />
                                            <label class="form-check-label" for="checkbox1"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="avatar"
                                            class="rounded-circle" width="35" />
                                        <div class="ms-3">
                                            <div class="user-meta-info">
                                                <h6 class="household-name mb-0" data-name="{{ $account->name }}">
                                                    {{ $account->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="usr-email-addr"
                                        data-serialnumber="{{ $account->serial_number ?? '-' }}">{{ $account->serial_number ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="household-address"
                                        data-address="{{ $account->address }}">{{ $account->address }}</span>
                                </td>
                                <td>
                                    <span class="household-fee"
                                        data-fee="{{ $account->fee }}">{{ $account->fee }}</span>
                                </td>
                                <td>
                                    <span class="household-phone"
                                        data-phone="{{ $account->phone ?? '-' }}">{{ $account->phone ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="action-btn">
                                        <a href="{{ route('households.edit', $account->id) }}"
                                            class="text-primary edit">
                                            <i class="ti ti-edit fs-5"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="text-dark delete ms-2">
                                            <i class="ti ti-trash fs-5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- end row -->
                        @empty
                            <tr>
                                <td colspan="7">No household data at the moment!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
