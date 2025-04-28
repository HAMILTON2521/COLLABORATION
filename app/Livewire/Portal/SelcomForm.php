<?php

namespace App\Livewire\Portal;

use App\Models\Payment;
use Livewire\Component;
use App\Models\Customer;
use App\Models\PushRequest;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;

#[Title('Buy Gas')]
class SelcomForm extends Component
{
    #[Validate('required|size:10|starts_with:0', as: 'phone number')]
    public $phone = '';

    #[Validate('required|decimal:0,2|min:100', as: 'amount')]
    public $amount = '';

    public $customer;
    public ?PushRequest $pushRequest;
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
                $payment = Payment::where('external_id', $pushRequest->mno_txn_id)->first();
                if ($payment) {
                    $this->redirectRoute('topup.payment.details', ['payment' => $payment->id], navigate: true);
                }
            } elseif ($pushRequest->status === "Pending") {
                $this->dispatch('showToast', message: 'We have not received the payment. Try again.', status: 'Unpaid');
            } elseif ($pushRequest->status === "Failed") {
                $this->dispatch('showToast', message: 'Your request failed. Try again', status: 'Failed');
                $this->phone = $pushRequest->phone;

                $this->pushRequest = null;
                $this->status = true;
            }
        }
    }

    public function save()
    {
        $validData = $this->validate();

        $order = $this->customer->selcomOrders()->create([
            'amount' => $validData['amount'],
            'status' => 'New'
        ]);

        if ($order) {
            flash()->success('Please check your phone and confirm PIN', [
                'timeout' => 10000
            ]);
            $this->reset(['amount', 'phone']);
        }
    }
    public function render()
    {
        return view('livewire.portal.selcom-form');
    }
}
