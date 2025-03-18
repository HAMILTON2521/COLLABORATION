<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    #[Validate('required|string|max:255', as: 'first name')]
    public $first_name = '';

    #[Validate('required|string|max:255', as: 'last name')]
    public $last_name = '';

    #[Validate('required|digits:6|unique:customers,ref', as: 'account')]
    public $account = '';

    #[Validate('required|size:10', as: 'phone number')]
    public $phone = '';

    #[Validate('nullable|email|max:60', as: 'email')]
    public $email = null;

    #[Validate('required|string|max:32', as: 'street')]
    public $street = null;

    #[Validate('required|exists:regions,id', as: 'region')]
    public $region = '';

    #[Validate('required|exists:districts,id', as: 'district')]
    public $district = '';

    public function store()
    {
        $validData = $this->validate();

        $customer = Customer::create([
            'first_name' => $validData['first_name'],
            'last_name' => $validData['last_name'],
            'ref' => $validData['account'],
            'region' => $validData['region'],
            'district' => $validData['district'],
            'phone' => $validData['phone'],
            'email' => $validData['email'],
            'street' => $validData['street']
        ]);

        if ($customer) {
            return true;
        }
    }
}
