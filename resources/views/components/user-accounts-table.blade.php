<div class="table-responsive">
    <table class="table search-table align-middle text-nowrap">
        <thead class="header-item">
            <tr>
                <th>Name</th>
                <th>Account</th>
                <th>Region</th>
                <th>District</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($accounts as $account)
                <!-- start row -->
                <tr wire:key="{{ $account->id }}" class="search-items">
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/profile/user-10.jpg') }}" alt="avatar"
                                class="rounded-circle" width="35" />
                            <div class="ms-3">
                                <div class="user-meta-info">
                                    <h6 class="mb-0" data-name="{{ $account->customer->full_name }}">
                                        {{ $account->customer->full_name }}</h6>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span data-ref="{{ $account->customer->ref }}">{{ $account->customer->ref }}</span>
                    </td>
                    <td>
                        <span
                            data-region="{{ $account->customer->region->name }}">{{ $account->customer->region->name }}</span>
                    </td>
                    <td>
                        <span
                            data-district="{{ $account->customer->district->name }}">{{ $account->customer->district->name }}</span>
                    </td>
                    <td>
                        <a href="javascript:;" wire:click.prevent="remove('{{ $account->id }}')"
                            class="d-block text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5">
                            <i class="ti ti-user-minus"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">There are no accounts assigned to this user!</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
