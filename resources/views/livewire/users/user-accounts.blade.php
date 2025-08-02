<div>
    <x-page-header mainTitle="User Accounts" subtitle="Users" />
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
                        <a href="{{ route('more.users.assign', $user->id) }}" id="btn-add-user"
                            class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-user-plus text-white me-1 fs-5"></i> Add More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <x-alert-status />
        <div class="card card-body">
            <x-user-accounts-table :accounts="$this->accounts" />
        </div>
    </div>
</div>
<x-toast />
@push('js')
    <script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endpush
