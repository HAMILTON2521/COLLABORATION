<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Customers')]
class Customers extends Component
{
    public function delete(Customer $customer)
    {
        $this->dispatch('not-allowed');
    }

    #[Computed]
    public function customers()
    {
        return Customer::latest()->get();
    }
    public function render()
    {
        return view('livewire.customer.customers');
    }
}
