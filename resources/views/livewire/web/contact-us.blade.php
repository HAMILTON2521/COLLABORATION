<div class="main-wrapper overflow-hidden">
    <!-- ------------------------------------- -->
    <!-- Banner Start -->
    <!-- ------------------------------------- -->
    <section class="py-7 py-md-5 bg-light-gray">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
                <h2 class="fs-15 fw-bolder mb-0">
                    We’d love to hear from you
                </h2>
                <div class="d-flex align-items-center gap-6">
                    <a href="{{ route('web.home-page') }}" class="text-muted fw-bolder link-primary fs-3 text-uppercase">
                        Home
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-5 text-muted"></iconify-icon>
                    <a href="#" class="text-primary link-primary fw-bolder fs-3 text-uppercase">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- Banner End -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Form Start -->
    <!-- ------------------------------------- -->
    <section class="py-lg-12 py-7 bg-light-gray">
        <div class="container-fluid">
            <div class="row gx-lg-7 gy-lg-0 gy-7">
                <div class="col-lg-4">
                    <div class="bg-primary p-7 rounded-4 position-relative bg-circle overflow-hidden">
                        <div class="pb-10 border-bottom border-white border-opacity-10 position-relative z-1">
                            <h3 class="text-white fs-6 fw-bolder mb-3">Reach Out Today</h3>
                            <p class="fs-4 mb-0 text-white">
                                Have questions or need assistance? We're just a message away.
                            </p>
                        </div>
                        <div class="pt-10 position-relative z-1">
                            <h3 class="text-white fs-6 fw-bolder mb-3">Our Location</h3>
                            <p class="fs-4 mb-0 text-white">
                                Visit us in person or find our contact details to connect with us directly.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="bg-white p-7 rounded-3">
                        <form wire:submit="save" autocomplete="off">
                            <div class="d-flex flex-column gap-sm-7 gap-3">
                                <div class="d-flex flex-sm-row flex-column gap-sm-7 gap-3">
                                    <div class="d-flex flex-column flex-grow-1 gap-2">
                                        <label for="first_name" class="fs-3 fw-semibold">
                                            First Name <span class="text-danger">*</span>
                                        </label>
                                        <x-input name="first_name" wire:model="form.first_name"
                                            class="form-control {{ $errors->has('form.first_name') ? 'is-invalid' : '' }}" />
                                        @error('form.first_name')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 gap-2">
                                        <label for="last_name" class="fs-3 fw-semibold">
                                            Last Name <span class="text-danger">*</span>
                                        </label>
                                        <x-input name="last_name" wire:model="form.last_name"
                                            class="form-control {{ $errors->has('form.last_name') ? 'is-invalid' : '' }}" />
                                        @error('form.last_name')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex flex-sm-row flex-column gap-sm-7 gap-3">
                                    <div class="d-flex flex-column flex-grow-1 gap-2">
                                        <label for="phone" class="fs-3 fw-semibold">
                                            Phone Number <span class="text-danger">*</span>
                                        </label>
                                        <x-input wire:model="form.phone" maxlength="10" name="phone"
                                            class="form-control {{ $errors->has('form.phone') ? 'is-invalid' : '' }}" />
                                        @error('form.phone')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 gap-2">
                                        <label for="email" class="fs-3 fw-semibold">
                                            Email
                                        </label>
                                        <input wire:model="form.email" type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('form.email') ? 'is-invalid' : '' }}">
                                        @error('form.email')
                                            <span class="validation-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <label for="enquire" class="fs-3 fw-semibold">Enquire related to <span
                                            class="text-danger">*</span></label>
                                    <select wire:model="form.subject"
                                        class="form-select w-auto {{ $errors->has('form.subject') ? 'is-invalid' : '' }}">
                                        <option value="" disabled>Choose...</option>
                                        <option value="General Enquiry">General Enquiry</option>
                                        <option value="Price Enquiry">Price Enquiry</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('form.subject')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <label for="message" class="fs-3 fw-semibold">Message</label>
                                    <textarea wire:model="form.message" name="message" id="message"
                                        class="form-control {{ $errors->has('form.message') ? 'is-invalid' : '' }}" rows="5"></textarea>
                                    @error('form.message')
                                        <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <x-primary-button class="mt-3 px-9 py-6">
                                    Send Message <span wire:loading wire:target="save"
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- Form End -->
    <!-- ------------------------------------- -->
</div>
