<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Customer Details')]
class CustomerDetails extends Component
{
    public $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function render()
    {
        return view('livewire.customer.customer-details');
    }
}
