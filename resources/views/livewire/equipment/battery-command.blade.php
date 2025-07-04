<div>
    <x-page-header mainTitle="Select Device" subtitle="Valve Control"/>
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-2 col-xl-1">
                    <select @disabled(count($this->customers) == 0) wire:model.live="perPage"
                            class="form-select w-auto">
                        @foreach ($this->pages as $page)
                            <option value="{{ $page }}">{{ $page }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="position-relative">
                        <input type="text" @disabled(count($this->customers) == 0) name="search"
                               wire:model.live.debounce.500ms="search" class="form-control product-search ps-5"
                               placeholder="Search ...">
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <x-alert-status/>

        <div class="row">
            <div class="@if (isset($selectedCustomer)) col-lg-8
            @else
                col-lg-12 @endif">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table search-table align-middle text-nowrap">
                            <thead class="header-item">
                            <tr>
                                <th>Name</th>
                                <th>Account</th>
                                <th>IMEI</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($this->customers as $customer)
                                <!-- start row -->
                                <tr class="bg-success" wire:key="{{ $customer->id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/images/profile/user-1.jpg') }}"
                                                 alt="avatar" class="rounded-circle" width="35"/>
                                            <div class="ms-3">
                                                <div>
                                                    <h6 class="mb-0">{{ $customer->full_name }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $customer->ref }}</td>
                                    <td>{{ $customer->imei }}</td>
                                    <td>
                                        <button wire:click="setCustomer('{{ $customer->id }}')" type="button"
                                                class="justify-content-center btn-sm btn mb-1 btn-rounded @if (isset($selectedCustomer) && $selectedCustomer->id === $customer->id) btn-success
                                                @else
                                                    btn-dark @endif d-flex align-items-center">
                                            @if (isset($selectedCustomer) && $selectedCustomer->id === $customer->id)
                                                <i class="ti ti-check fs-4 me-2"></i>
                                            @else
                                                <i class="ti ti-send fs-4 me-2"></i>
                                            @endif

                                            @if (isset($selectedCustomer) && $selectedCustomer->id === $customer->id)
                                                Selected
                                            @else
                                                Select
                                            @endif
                                        </button>

                                    </td>
                                </tr>
                                <!-- end row -->
                            @empty
                                <tr>
                                    <td colspan="6">No customer data at the moment!</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $this->customers->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
            </div>
            @isset($selectedCustomer)
                <div class="col-lg-4 d-flex align-items-stretch">
                    <!-- start Radios - Default -->
                    <div class="card w-100">
                        <div class="p-3 pt-5">
                            <div class="text-center">
                                @isset($selectedCustomer)
                                    <button wire:click="sendCommand" type="button" class="btn btn-primary">
                                        Submit
                                        <x-spinner target="sendCommand"/>
                                    </button>
                                @endisset
                                <button type="button" wire:click="resetCustomer"
                                        class="btn bg-danger-subtle text-danger ms-6 px-4">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end Radios - Default -->
                </div>
            @endisset
        </div>
    </div>
    @livewire('utils.custom-modal')
</div>
<x-toast/>
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
