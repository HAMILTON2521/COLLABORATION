<div>
    <x-page-header mainTitle="Assign Account" subtitle="Users" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <form class="position-relative">
                        <input type="text" class="form-control product-search ps-5" id="input-search"
                            placeholder="Search accounts..." />
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </form>
                </div>
                <div
                    class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <div class="">
                        <button wire:click.prevent="assignSelected" wire:loading.attr="disabled"
                            wire:target="assignSelected" @disabled($selectedAccounts == [])
                            class="btn btn-primary me-2 d-flex align-items-center ">
                            <i wire:loading.class="d-none" wire:target="assignSelected"
                                class="ti ti-check me-1 fs-5"></i>
                            <span wire:loading wire:target="assignSelected"
                                class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Assign Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                        <tr>
                            <th>Name</th>
                            <th>Account</th>
                            <th>Region</th>
                            <th>District</th>
                            <th>
                                <div class="n-chk align-self-center text-center">
                                    <div class="form-check">
                                        <input wire:show="" type="checkbox" class="form-check-input primary"
                                            id="contact-check-all" wire:click="selectAll"
                                            {{ count($this->selectedAccounts) === $this->customers->count() ? 'checked' : '' }} />
                                        <label class="form-check-label" for="contact-check-all"></label>
                                        <span class="new-control-indicator"></span>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->customers as $customer)
                            <!-- start row -->
                            <tr wire:key="{{ $customer->id }}" class="search-items">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/profile/user-10.jpg') }}" alt="avatar"
                                            class="rounded-circle" width="35" />
                                        <div class="ms-3">
                                            <div class="user-meta-info">
                                                <h6 class="mb-0" data-name="{{ $customer->full_name }}">
                                                    {{ $customer->full_name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span data-ref="{{ $customer->ref }}">{{ $customer->ref }}</span>
                                </td>
                                <td>
                                    <span
                                        data-region="{{ $customer->region->name }}">{{ $customer->region->name }}</span>
                                </td>
                                <td>
                                    <span
                                        data-district="{{ $customer->district->name }}">{{ $customer->district->name }}</span>
                                </td>
                                <td>
                                    <div class="n-chk align-self-center text-center">
                                        <div class="form-check">
                                            <input
                                                wire:click="setSelectedAccount('{{ $customer->id }}', $event.target.checked)"
                                                type="checkbox" class="form-check-input contact-chkbox primary"
                                                id="checkbox{{ $customer->id }}" />
                                            <label class="form-check-label" for="checkbox{{ $customer->id }}"></label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">There are no accounts to assign!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-toast />
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
