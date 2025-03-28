<?php

namespace App\Livewire\Portal;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Account')]
class Account extends Component
{
    public function buyGas(Customer $customer)
    {
        $this->redirectRoute('portal.account.buy', ['customer' => $customer]);
    }
    public function render()
    {
        return view('livewire.portal.account');
    }
}
