<?php

namespace App\Livewire\Equipment;

use App\Models\Customer;
use App\Models\ValveControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OpenValve extends Component
{
    public Customer $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function open()
    {
        $command = ValveControl::create([
            'source' => 'Manual',
            'user_id' => Auth::id(),
            'state' => 1,
            'customer_id' => $this->customer->id,
        ]);

        if ($command) {
            session()->flash('success', 'Valve control command sent ' . $command->error_message);

            $this->redirectRoute('more.equipment.valve.details', ['valve' => $command->id]);
        }
    }
    public function render()
    {
        return view('livewire.equipment.open-valve');
    }
}
