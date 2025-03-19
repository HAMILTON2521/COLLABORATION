<div>
    <x-page-header mainTitle="System Users" subtitle="Users" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-2 col-xl-1">
                    <select wire:model.live="perPage" class="form-select w-auto">
                        @foreach ($this->pages as $page)
                            <option value="{{ $page }}">{{ $page }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="position-relative">
                        <x-input name="search" wire:model.live.debounce.500ms="search"
                            class="form-control product-search ps-5" placeholder="Search ..." />
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                <div
                    class="col-md-6 col-xl-8 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @forelse ($this->users as $user)
                            <!-- start row -->
                            <tr wire:key="{{ $user->id }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="avatar"
                                            class="rounded-circle" width="35" />
                                        <div class="ms-3">
                                            <div>
                                                <h6 class="mb-0">
                                                    <a
                                                        href="{{ route('more.users.show', $user->id) }}">{{ $user->full_name }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <x-status-badge color="{{ $user->status_color }}"
                                        label="{{ $user->user_type }}" />
                                </td>
                                <td>
                                    <x-action-buttons viewUrl="{{ route('more.users.show', $user->id) }}"
                                        editUrl="{{ route('more.users.edit', $user->id) }}" />

                                </td>
                            </tr>
                            <!-- end row -->
                        @empty
                            <tr>
                                <td colspan="5">No user data at the moment!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $this->users->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
