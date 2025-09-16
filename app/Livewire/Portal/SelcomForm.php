<?php

namespace App\Livewire\Portal;

use App\Models\Payment;
use Livewire\Component;
use App\Models\Customer;
use App\Models\IncomingRequest;
use App\Models\PushRequest;
use App\Models\SelcomOrder;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;

#[Title('Buy Gas')]
class SelcomForm extends Component
{
    #[Validate('required|size:10|starts_with:0', as: 'phone number')]
    public $phone = '';

    #[Validate('required|decimal:0,2|min:200', as: 'amount')]
    public $amount = '';

    public $customer;
    public ?SelcomOrder $selcomOrder;
    public $status = true;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    #[On('selcom-request-created')]
    public function pushRequestCreated(SelcomOrder $selcomOrder)
    {
        $this->selcomOrder = $selcomOrder;
        $this->status = false;
    }

    public function checkPaymentStatus()
    {
        $this->selcomOrder = SelcomOrder::findOrFail($this->selcomOrder->id);

        if ($this->selcomOrder->status != 'Success') {
            if ($this->selcomOrder->is_paid) {
                $this->redirectRoute('topup.payment.details', ['payment' => $this->selcomOrder->payment_id], navigate: true);
            }
        }

    }

    public function save()
    {
        $validData = $this->validate();

        $order = $this->customer->selcomOrders()->create([
            'amount' => $validData['amount'],
            'phone' => $validData['phone'],
            'status' => 'New'
        ]);

        if ($order) {
            $this->dispatch('selcom-request-created', selcomOrder: $order->id);
            $this->reset(['amount', 'phone']);
            if ($order->status == 'New') {
                $this->dispatch('showToast', message: 'Please check your phone and confirm PIN.', status: 'Success');
            }
        }
    }
    public function render()
    {
        return view('livewire.portal.selcom-form');
    }
}
