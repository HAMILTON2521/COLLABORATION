<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
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
    public function editCustomer()
    {
        $this->redirectRoute('customers.edit', ['customer' => $this->customer->id], navigate: true);
    }
    public function queryRealTimeData()
    {
        $data = $this->customer->realTimeData()->create([
            'source' => 'Manual',
            'user_id' => Auth::id(),
            'status' => 'New',
        ]);
        if ($data) {
            $this->dispatch('real-time-data-created', id: $data->id);
        }
    }
    public function checkBalance()
    {
        //
    }
    public function render()
    {
        return view('livewire.customer.customer-details');
    }
}
