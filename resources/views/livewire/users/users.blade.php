<div>
    <x-page-header mainTitle="System Users" subtitle="Users" />
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
                    <div class="action-btn show-btn">
                        <a href="javascript:void(0)"
                            class="delete-multiple bg-danger-subtle btn me-2 text-danger d-flex align-items-center ">
                            <i class="ti ti-trash me-1 fs-5"></i> Delete All Row
                        </a>
                    </div>
                    <a href="{{ route('more.users.create') }}" wire:navigate id="btn-add-user"
                        class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-user-plus text-white me-1 fs-5"></i> Add User
                    </a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success text-success" role="alert">
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif

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
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @forelse ($this->users as $user)
                            <!-- start row -->
                            <tr wire:key="{{ $user->id }}" class="search-items">
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
                                                <h6 class="mb-0" data-name="{{ $user->full_name }}">
                                                    {{ $user->full_name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="email" data-email="{{ $user->email }}">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="phone" data-phone="{{ $user->phone }}">{{ $user->phone }}</span>
                                </td>
                                <td>
                                    <span class="user-type"
                                        data-user-type="{{ $user->user_type }}">{{ $user->user_type }}</span>
                                </td>
                                <td>
                                    <x-action-buttons viewUrl="{{ route('more.users.show', $user->id) }}"
                                        editUrl="{{ route('more.users.edit', $user->id) }}" />

                                </td>
                            </tr>
                            <!-- end row -->
                        @empty
                            <tr>
                                <td colspan="6">No user data at the moment!</td>
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
