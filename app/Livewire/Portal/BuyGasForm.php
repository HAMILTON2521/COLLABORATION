<?php

namespace App\Livewire\Portal;

use App\Models\Customer;
use App\Models\PushRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;

use LivewireUI\Modal\ModalComponent;

class BuyGasForm extends ModalComponent
{
    #[Validate('required|size:10', as: 'phone number')]
    public $phone = '';

    #[Validate('required|integer|min:100', as: 'amount')]
    public $amount = '';

    public Customer $customer;

    public function save()
    {
        $validData = $this->validate();

        $pushRequestData = $this->customer->pushRequests()->create([
            'amount' => $validData['amount'],
            'phone' => $validData['phone'],
            'channel' => 'Airtel',
            'status' => 'New'
        ]);
        if ($pushRequestData) {
            $this->dispatch('push-request-created', pushRequest: $pushRequestData->id)->to(BuyGas::class);
            $this->reset();
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.portal.buy-gas-form');
    }
}
