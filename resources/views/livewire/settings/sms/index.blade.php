<div class="row">
    <div class="col-lg-12">
        <div class="card border shadow-none">
            <div class="card-body p-4">
                @forelse ($this->settings as $setting)
                    <div wire:key="{{ $setting->id }}"
                        class="d-flex mb-2 bg-hover-light-black align-items-center justify-content-between p-3 border-bottom border-rounded rounded">
                        <div>
                            <h5 class="fs-4 fw-semibold mb-0">
                                {{ $setting->key }}</h5>
                            <p class="mb-0">{{ $setting->value }}</p>
                        </div>

                        <ul class="list-unstyled mb-0 d-flex align-items-center">
                            <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="View">
                                <a wire:loading.remove wire:target="viewSmsSetting('{{ $setting->id }}')"
                                    class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                    href="javascript:;" wire:click="viewSmsSetting('{{ $setting->id }}')">
                                    <i class="ti ti-info-circle"></i>
                                    <x-spinner target="viewSmsSetting('{{ $setting->id }}')" />
                                </a>
                            </li>
                            @if ($setting->editable)
                                <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Edit">
                                    <a wire:loading.remove wire:target="editSmsSetting('{{ $setting->id }}')"
                                        class="d-block text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                                        href="javascript:;" wire:click="editSmsSetting('{{ $setting->id }}')">
                                        <i class="ti ti-pencil-minus"></i>
                                        <x-spinner target="editSmsSetting('{{ $setting->id }}')" />
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @empty
                    <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
                        role="alert">
                        <span class="side-line bg-success"></span>

                        <div class="d-flex align-items-center ">
                            <i class="ti ti-info-circle fs-5 text-secondary me-2 flex-shrink-0"></i>
                            <span class="text-truncate">No settings data available.</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @livewire('utils.custom-modal')
</div>
<x-modal />
