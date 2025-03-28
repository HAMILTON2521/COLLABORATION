<?php

namespace App\Livewire\Portal;

use App\Models\Customer;
use App\Models\PushRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Buy Gas')]
class BuyGas extends Component
{
    public Customer $customer;
    public PushRequest $pushRequest;
    public $status = true;

    #[On('push-request-created')]
    public function pushRequestCreated(PushRequest $pushRequest)
    {
        $this->pushRequest = $pushRequest;
        $this->status = false;
    }

    public function render()
    {
        return view('livewire.portal.buy-gas');
    }
}
