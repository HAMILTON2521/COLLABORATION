<div>
    <x-page-header mainTitle="Create Customer" subtitle="Customers"/>
    <x-form wire:submit="save" autocomplete="off" class="form-horizontal">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card border-top border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-7">
                            <h4 class="card-title">Customer Details</h4>

                            <button class="navbar-toggler border-0 shadow-none d-md-none" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight">
                                <i class="ti ti-menu fs-5 d-flex"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="first_name" class="form-label">First Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.first_name" name="first_name"
                                             class="form-control {{ $errors->has('form.first_name') ? 'is-invalid' : '' }}"/>
                                    @error('form.first_name')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="last_name" class="form-label">Last Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.last_name" name="last_name"
                                             class="form-control {{ $errors->has('form.name') ? 'is-invalid' : '' }}"/>
                                    @error('form.last_name')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="occupation" class="form-label">Occupation </label>
                                    <x-input maxlength="6" wire:model="form.occupation" name="occupation"
                                             class="form-control {{ $errors->has('form.occupation') ? 'is-invalid' : '' }}"/>
                                    @error('form.occupation')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="house_number" class="form-label">House Number</label>
                                    <x-input wire:model="form.house_number" name="house_number" maxlength="10"
                                             class="form-control {{ $errors->has('form.house_number') ? 'is-invalid' : '' }}"/>
                                    @error('form.house_number')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="family_size" class="form-label">Family Size</label>
                                    <x-input wire:model="form.family_size" name="family_size" maxlength="10"
                                             class="form-control {{ $errors->has('form.family_size') ? 'is-invalid' : '' }}"/>
                                    @error('form.family_size')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="cooks_per_day" class="form-label">How many times you cook per
                                        day?</label>
                                    <x-input wire:model="form.cooks_per_day" name="cooks_per_day" maxlength="10"
                                             class="form-control {{ $errors->has('form.cooks_per_day') ? 'is-invalid' : '' }}"/>
                                    @error('form.cooks_per_day')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="current_source" class="form-label">Current Source of Energy <span
                                            class="text-danger">*</span></label>
                                    <select wire:model.live="form.current_source"
                                            class="form-select mr-sm-2  {{ $errors->has('form.current_source') ? 'is-invalid' : '' }}"
                                            id="current_source">
                                        <option value="" selected>Select from list</option>
                                        <option value="Electricity">Electricity</option>
                                        <option value="Gas">Gas</option>
                                        <option value="Charcoal">Charcoal</option>
                                        <option value="Firewood">Firewood</option>
                                        <option value="Mixture">Mixture of two or more sources</option>
                                    </select>
                                    @error('form.current_source')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="ref" class="form-label">Account <span class="text-danger">*</span>
                                    </label>
                                    <x-input maxlength="6" wire:model="form.account" name="ref"
                                             class="form-control {{ $errors->has('form.account') ? 'is-invalid' : '' }}"/>
                                    @error('form.account')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="imei" class="form-label">IMEI <span class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.imei" name="imei"
                                             class="form-control {{ $errors->has('form.imei') ? 'is-invalid' : '' }}"/>
                                    @error('form.imei')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.phone" name="phone" maxlength="10"
                                             class="form-control {{ $errors->has('form.phone') ? 'is-invalid' : '' }}"/>
                                    @error('form.phone')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="alt_phone" class="form-label">Alternative Phone</label>
                                    <x-input wire:model="form.alt_phone" name="alt_phone" maxlength="10"
                                             class="form-control {{ $errors->has('form.alt_phone') ? 'is-invalid' : '' }}"/>
                                    @error('form.alt_phone')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email </label>
                                    <input wire:model="form.email" name="email" id="email" type="email"
                                           class="form-control {{ $errors->has('form.email') ? 'is-invalid' : '' }}">
                                    @error('form.email')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="region" class="form-label">Region <span
                                            class="text-danger">*</span></label>
                                    <select wire:model.live="form.region"
                                            class="form-select mr-sm-2  {{ $errors->has('form.region') ? 'is-invalid' : '' }}"
                                            id="region">
                                        <option value="" disabled>Choose region...</option>
                                        @foreach ($this->regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.region')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="district" class="form-label">District <span
                                            class="text-danger">*</span></label>
                                    <select wire:model.live="form.district"
                                            class="form-select mr-sm-2  {{ $errors->has('form.district') ? 'is-invalid' : '' }}"
                                            id="district" wire:key="{{ $this->form->region }}">
                                        <option value="" disabled>Choose district...</option>
                                        @foreach (\App\Models\District::where('region_id', $this->form->region)->orderBy('name', 'asc')->get() as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.district')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="street" class="form-label">Street <span
                                            class="text-danger">*</span>
                                    </label>
                                    <x-input wire:model="form.street" name="street"
                                             class="form-control {{ $errors->has('form.street') ? 'is-invalid' : '' }}"/>
                                    @error('form.street')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="ward" class="form-label">Ward</label>
                                    <x-input wire:model="form.ward" name="ward"
                                             class="form-control {{ $errors->has('form.ward') ? 'is-invalid' : '' }}"/>
                                    @error('form.ward')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <x-input wire:model="form.latitude" name="latitude"
                                             class="form-control {{ $errors->has('form.latitude') ? 'is-invalid' : '' }}"/>
                                    @error('form.latitude')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <x-input wire:model="form.longitude" name="longitude"
                                             class="form-control {{ $errors->has('form.longitude') ? 'is-invalid' : '' }}"/>
                                    @error('form.longitude')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="photo" class="form-label">Upload passport size photo</label>
                                    <input wire:model="form.photo" class="form-control" type="file"
                                           id="photo" name="photo" accept="image/*">
                                    @error('form.photo')
                                    <span class="validation-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                        <x-spinner target="save"/>
                    </button>
                </div>
            </div>
        </div>
    </x-form>
</div>
