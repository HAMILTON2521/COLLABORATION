<div>
    <x-page-header mainTitle="MyAccount" subtitle="Account" />
    <div class="card">
        <div class="card-header text-bg-primary">
            <h5 class="mb-0 text-white">{{ Auth::user()->full_name }}</h5>
        </div>
        <form class="form-horizontal">
            <div class="form-body">
                <div class="card-body">
                    <h5 class="card-title mb-0">Personal Info</h5>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Email:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Phone:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{ Auth::user()->phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Status:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"><span
                                            class="mb-1 badge rounded-pill  bg-info-subtle text-info">{{ Auth::user()->user_status }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Meters:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">
                                        <span
                                            class="mb-1 badge rounded-pill text-bg-success">{{ count(Auth::user()->accounts) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <h5 class="card-title mb-0">Meters</h5>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    @empty(Auth::user()->accounts)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
                                    role="alert">
                                    <span class="side-line bg-success"></span>
                                    <div class="d-flex align-items-center ">
                                        <i class="ti ti-info-circle fs-5 text-secondary me-2 flex-shrink-0"></i>
                                        <span class="text-truncate">No meter is assigned to your profile</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endempty
                    @unless (count(Auth::user()->accounts) == 0)
                        <div class="row">
                            <div class="col-md-12">
                                <ol class="list-group list-group-numbered">
                                    @foreach (Auth::user()->accounts as $account)
                                        <li class="list-group-item d-flex justify-content-between align-items-start m-0">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{ $account->customer->full_name }}</div>
                                                {{ $account->customer->ref }}
                                            </div>
                                            <button type="button" wire:click="buyGas('{{ $account->customer->id }}')"
                                                class="btn btn-info">
                                                Buy Gas
                                            </button>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    @endunless
                </div>
                <div class="form-actions border-top">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-edit fs-5"></i>
                                            Edit
                                        </button>
                                        <button type="button" class="btn bg-danger-subtle text-danger ms-6">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
