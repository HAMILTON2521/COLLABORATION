<div>
    <x-page-header mainTitle="Households" subtitle="Households" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <form class="position-relative">
                        <input type="text" class="form-control product-search ps-5" id="input-search"
                            placeholder="Search ..." />
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
                <div
                    class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <a wire:click="fetchFromRemote" href="javascript:;"
                        class="btn btn-success d-flex align-items-center me-3">
                        <i class="ti ti-plus text-white me-1 fs-5"></i> Fetch Households <span wire:loading
                            wire:target="fetchFromRemote" class="spinner-border spinner-border-sm ml-1" role="status"
                            aria-hidden="true"></span>
                    </a>
                    <a href="{{ route('households.create') }}" id="btn-add-contact"
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
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="avatar"
                                            class="rounded-circle" width="35" />
                                        <h6> {{ $account->name }}</h6>
                                    </div>
                                </td>
                                <td>{{ $account->serial_number ?? '-' }}</td>
                                <td>{{ $account->address }}</td>
                                <td>{{ $account->fee }}</td>
                                <td>{{ $account->phone ?? '-' }}</td>
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
