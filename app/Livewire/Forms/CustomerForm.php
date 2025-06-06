<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class CustomerForm extends Form
{
    #[Validate('required|string|max:255', as: 'first name')]
    public $first_name = '';

    #[Validate('required|string|max:255', as: 'last name')]
    public $last_name = '';

    #[Validate('nullable|string|max:32', as: 'house number')]
    public $house_number = '';

    #[Validate('nullable|string|max:32', as: 'occupation')]
    public $occupation = '';

    #[Validate('nullable|string|max:32', as: 'family size')]
    public $family_size = '';

    #[Validate('nullable|string|max:32', as: 'cooks per day')]
    public $cooks_per_day = '';

    #[Validate('required|in:Gas,Charcoal,Mixture,Electricity,Firewood', as: 'current energy source')]
    public $current_source = '';

    #[Validate('required|digits:6|unique:customers,ref', as: 'account')]
    public $account = '';

    #[Validate('required|string|unique:customers,imei', as: 'meter number')]
    public $imei = '';

    #[Validate('required|size:10', as: 'phone number')]
    public $phone = '';

    #[Validate('nullable|size:10', as: 'alternative phone number')]
    public $alt_phone = '';

    #[Validate('nullable|email|max:60', as: 'email')]
    public $email = null;

    #[Validate('required|string|max:32', as: 'street')]
    public $street = null;

    #[Validate('nullable|string', as: 'ward')]
    public $ward = null;

    #[Validate('nullable|string', as: 'latitude')]
    public $latitude = null;

    #[Validate('nullable|string', as: 'longitude')]
    public $longitude = null;

    #[Validate('required|exists:regions,id', as: 'region')]
    public $region = '';

    #[Validate('required|exists:districts,id', as: 'district')]
    public $district = '';

    #[Validate('nullable|image|max:1024')]
    public $photo;

    public function store()
    {
        $validData = $this->validate();

        $customer = Customer::create([
            'first_name' => Str::ucfirst(Str::lower($validData['first_name'])),
            'last_name' => Str::ucfirst(Str::lower($validData['last_name'])),
            'ref' => $validData['account'],
            'region_id' => $validData['region'],
            'district_id' => $validData['district'],
            'phone' => $validData['phone'],
            'email' => $validData['email'],
            'street' => $validData['street'],
            'imei' => $validData['imei'],
            'ward' => $validData['ward'],
            'latitude' => $validData['latitude'],
            'longitude' => $validData['longitude'],
            'family_size' => $validData['family_size'],
            'house_number' => $validData['house_number'],
            'occupation' => $validData['occupation'],
            'current_energy_source' => $validData['current_source'],
            'cooks_per_day' => $validData['cooks_per_day'],
            'alternative_phone_number' => $validData['alt_phone'],
        ]);

        if ($customer) {
            if (isset($validData['photo'])) {
                if (!Storage::disk('public')->exists('customer_photos')) {
                    Storage::disk('public')->makeDirectory('customer_photos');
                }
                try {
                    $filePath = $this->photo->store('customer_photos', 'public');
                    $existing = $customer->photo;
                    if ($existing) {
                        // Delete old file if it exists
                        if (Storage::disk('public')->exists($existing->photo)) {
                            Storage::disk('public')->delete($existing->photo);
                        }
                        // Update existing record
                        $existing->update(['photo' => $filePath]);
                    } else {
                        // Create new record
                        $customer->photo()->create(['photo' => $filePath]);
                    }
                } catch (\Exception $e) {
                    Log::error("Failed to upload file for create_customer", ['error' => $e->getMessage()]);
                }
            }
            return true;
        }
    }
}
