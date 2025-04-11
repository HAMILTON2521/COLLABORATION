<?php

namespace App\Livewire\Topup;

use App\Models\Customer;
use App\Models\IncomingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Recharge Device')]
class RechargeDevice extends Component
{
    public Customer $customer;

    #[Validate('required|numeric|min:100')]
    public $amount;

    #[Validate('required|string|max:26')]
    public $ref;
    #[Validate('nullable|string|max:255')]
    public $remarks;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function save()
    {
        $validData = $this->validate();
        $incomingRequest = $this->customer->incomingReequests()->create([
            'amount' => $validData['amount'],
            'type' => 'Payment',
            'request' => 'Process',
            'channel' => 'Manual',
            'reference' => $this->customer->ref,
            'reference_1' => $validData['ref'],
            'remarks' => $validData['remarks'],
            'status' => 'Success',
            'customer_msisdn' => $this->customer->phone,
            'customer_name' => $this->customer->full_name,
            'customer_id' => $this->customer->id,
            'created_by' => Auth::user()->id,

        ]);

        if ($incomingRequest) {
            session()->flash('success', 'Device credited successfully');
            $this->redirectRoute('topup.payment.details', $incomingRequest->payment->id);
        }
    }
    public function render()
    {
        return view('livewire.topup.recharge-device');
    }
}
