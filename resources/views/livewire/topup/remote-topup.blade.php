<div>
    <x-page-header mainTitle="Select Customer" subtitle="Topup" />
    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-2 col-xl-1">
                    <select @disabled(count($this->customers) == 0) wire:model.live="perPage" class="form-select w-auto">
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
        <x-alert-status />

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table search-table align-middle text-nowrap">
                            <thead class="header-item">
                                <tr>
                                    <th>Name</th>
                                    <th>Account</th>
                                    <th>IMEI</th>
                                    <th>Region</th>
                                    <th>District</th>
                                    <th>Created At</th>
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
                                                    alt="avatar" class="rounded-circle" width="35" />
                                                <div class="ms-3">
                                                    <div>
                                                        <h6 class="mb-0">
                                                            <a class="link-success"
                                                                href="{{ route('customers.details', $customer->id) }}">{{ $customer->full_name }}</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $customer->ref }}</td>
                                        <td>{{ $customer->imei }}</td>
                                        <td><a class="link-success"
                                                href="{{ route('customers.region', $customer->region_id) }}">{{ $customer->region->name }}</a>
                                        </td>
                                        <td>{{ $customer->district->name }}</td>
                                        <td>{{ date('d M Y', strtotime($customer->created_at)) }}</td>
                                        <td>
                                            <button wire:click="topup('{{ $customer->id }}')" type="button"
                                                class="justify-content-center btn-sm btn mb-1 btn-rounded btn-primary d-flex align-items-center">
                                                <i class="ti ti-send fs-4 me-2"></i>
                                                Topup
                                            </button>

                                        </td>
                                    </tr>
                                    <!-- end row -->
                                @empty
                                    <tr>
                                        <td colspan="7">No customer data at the moment!</td>
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
        </div>
    </div>
</div>
