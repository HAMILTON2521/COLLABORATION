<?php

namespace App\Livewire\Forms;

use App\Models\Household;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HouseholdForm extends Form
{

    #[Validate('required|string|max:255', as: 'name')]
    public $name = '';

    #[Validate('required|string|max:255', as: 'address')]
    public $address = '';

    #[Validate('required|size:10', as: 'phone number')]
    public $phone = '';

    #[Validate('nullable|integer|min:0', as: 'warn money')]
    public $warn_money = 0;

    #[Validate('nullable|integer|min:0', as: 'fee')]
    public $fee = 0;

    public $password = '123456';

    public function store()
    {
        $validData = $this->validate();

        $household = Household::create([
            'name' => $validData['name'],
            'address' => $validData['address'],
            'fee' => $validData['fee'] ?? null,
            'warn_money' => $validData['warn_money'] ?? null,
            'created_by' => Auth::user()->id,
            'password' => Hash::make($this->password),
            'phone' => $validData['phone'],
            'status' => 'Pending',
        ]);

        if ($household) {
            return $household;
        }
    }
}
