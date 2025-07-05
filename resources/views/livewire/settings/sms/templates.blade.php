<div>
    <div class="row justify-content-center">
        @forelse ($this->smsTemplates as $template)
            <div class="col-lg-12" wire:key="{{ $template->id }}">
                <div class="card border shadow-none">
                    <div class="card-body p-4">
                        <h4 class="card-title">{{ $template->title }}</h4>
                        <p class="card-subtitle">{{ $template->description }}</p>
                        <div class="d-flex align-items-center justify-content-between mt-7">
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti {{ $template->ti_icon }} text-dark d-block fs-7" width="22"
                                       height="22"></i>
                                </div>
                                <div>
                                    <h5 class="fs-4 fw-semibold">Placeholders</h5>
                                    <p class="mb-0 text-muted">{{ $template->placeholders }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-end mt-4">
                                <a wire:loading.remove wire:target="editTemplate('{{ $template->id }}')"
                                   class="text-dark fs-6 d-flex bg-transparent p-2 fs-4 rounded-circle"
                                   href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                   data-bs-title="Edit"
                                   wire:click="editTemplate('{{ $template->id }}')">
                                    <i class="ti ti-pencil-minus"></i>
                                    <x-spinner target="editTemplate('{{ $template->id }}')"/>
                                </a>
                                <a class="text-dark fs-6 d-flex bg-transparent p-2 fs-4 rounded-circle"
                                   href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                   wire:confirm="Delete message template '{{ $template->title }}'?"
                                   wire:click="deleteSmsTemplate('{{ $template->id }}')" data-bs-title="Edit">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </div>
                        </div>
                        <p class="my-2">{{ $template->body }} </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger text-danger" role="alert">
                <strong>Error - </strong> No SMS templates available.
            </div>
        @endforelse

    </div>
    @livewire('utils.custom-modal')
</div>
<x-modal/>
