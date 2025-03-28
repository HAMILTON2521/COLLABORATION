<?php

namespace App\Livewire\Portal;

use App\Models\Customer;
use App\Models\PushRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Buy Gas')]
class BuyGasForm extends Component
{
    #[Validate('required|size:10|starts_with:0', as: 'phone number')]
    public $phone = '';

    #[Validate('required|integer|min:100', as: 'amount')]
    public $amount = '';

    public $customer;
    public PushRequest $pushRequest;
    public $status = true;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    #[On('push-request-created')]
    public function pushRequestCreated(PushRequest $pushRequest)
    {
        $this->pushRequest = $pushRequest;
        $this->status = false;
    }

    public function checkTransaction()
    {
        $pushRequest = PushRequest::findOrFail($this->pushRequest->id);
        if ($pushRequest) {
            if ($pushRequest->status === "Success") {
                //
            } else {
                $this->dispatch('showToast', message: 'We have not received the payment. Try again.', status: 'Unpaid');
            }
        }
    }

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
            $this->dispatch('push-request-created', pushRequest: $pushRequestData->id);
            $this->reset('phone', 'amount');
            $this->dispatch('showToast', message: 'Please check your phone and confirm PIN.', status: 'Success');
        }
    }

    public function render()
    {
        return view('livewire.portal.buy-gas-form');
    }
}
