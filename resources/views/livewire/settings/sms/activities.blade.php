<div class="row justify-content-center">
    @forelse ($this->activities as $activity)
        <div class="col-lg-12" wire:key="{{ $activity->id }}">
            <div class="card border shadow-none">
                <div class="card-body p-4">
                    <h4 class="card-title">{{ $activity->activity }}</h4>
                    <p class="card-subtitle">{{ $activity->description }}</p>
                    <div class="d-flex align-items-center justify-content-between mt-7">
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-message-bolt text-dark d-block fs-7" width="22" height="22"></i>
                            </div>
                            <div>
                                <h5 class="fs-4 fw-semibold">Message Tamplate</h5>
                                <p class="mb-0 text-muted">
                                    @if ($activity->template)
                                        {{ $activity->template->title }}
                                    @else
                                        <a href="javascript:;" class="link-success"
                                            wire:click="$dispatch('showModal', {data:{alias:'settings.sms.assign-template','size' :'modal-lg', params:{activity: '{{ $activity->id }}'}}})">Assign
                                            template</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-4">
                            <a class="text-dark fs-6 d-flex bg-transparent p-2 fs-4 rounded-circle"
                                href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Edit"
                                wire:click="$dispatch('showModal', {data:{alias:'settings.sms.edit-activity','size' :'modal-lg', params:{activity: '{{ $activity->id }}'}}})">
                                <i class="ti ti-pencil-minus"></i>
                            </a>
                            <a class="text-dark fs-6 d-flex bg-transparent p-2 fs-4 rounded-circle"
                                href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                wire:confirm="Delete {{ $activity->title }}?"
                                wire:click="deleteSmsactivity('{{ $activity->id }}')" data-bs-title="Edit">
                                <i class="ti ti-trash"></i>
                            </a>
                        </div>
                    </div>
                    <p class="my-2">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" disabled value="1" id="flexCheckDefault"
                            name="sendMessage" @checked($activity->send_message)>
                        <label class="form-check-label" for="flexCheckDefault">
                            @if ($activity->send_message)
                                Sending messages is enabled for this activity
                            @else
                                Sending messages is disabled for this activity
                            @endif
                        </label>
                    </div>
                    </p>

                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-danger text-danger" role="alert">
            <strong>Error - </strong> No data to display.
        </div>
    @endforelse
</div>
