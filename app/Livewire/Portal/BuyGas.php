<?php

namespace App\Livewire\Portal;

use App\Models\Customer;
use App\Models\PushRequest;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Buy Gas')]
class BuyGas extends Component
{
    public Customer $customer;

    public function openModal()
    {
        $this->dispatch('openModal', [
            'component' => 'portal.buy-gas-form',
            'arguments' => ['customer' => $this->customer]
        ]);
    }

    public function render()
    {
        return view('livewire.portal.buy-gas');
    }
}
