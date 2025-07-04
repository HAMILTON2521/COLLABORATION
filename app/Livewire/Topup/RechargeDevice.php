<?php

namespace App\Livewire\Topup;

use App\Models\Customer;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Recharge Device')]
class RechargeDevice extends Component
{
    public Customer $customer;

    public int $amount;
    public string $ref = '';
    public string $remarks = '';
    public int $minimum_amount = 0;

    public function mount(Customer $customer): void
    {
        $setting = Setting::where('key', 'MINIMUM_PAYMENT_AMOUNT')->first();
        $this->minimum_amount = (int)$setting->value;

        $this->customer = $customer;
    }

    public function save(): void
    {
        $validData = $this->validate([
            'ref' => 'required|string|max:26',
            'amount' => 'required|numeric|gte:minimum_amount',
            'remarks' => 'nullable|string|max:255',
            'minimum_amount' => 'required|numeric|gt:0',
        ]);
        try {
            $incomingRequest = $this->customer->incomingRequests()->create([
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
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.topup.recharge-device');
    }
}
