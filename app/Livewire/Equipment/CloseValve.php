<?php

namespace App\Livewire\Equipment;

use App\Models\Customer;
use App\Models\ValveControl;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CloseValve extends Component
{
    public Customer $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function close()
    {
        $command = ValveControl::create([
            'source' => 'Manual',
            'user_id' => Auth::id(),
            'state' => 0,
            'customer_id' => $this->customer->id,
        ]);

        if ($command) {
            session()->flash('success', 'Valve control command sent ' . $command->error_message);

            $this->redirectRoute('more.equipment.valve.details', ['valve' => $command->id]);
        }
    }

    public function render()
    {
        return view('livewire.equipment.close-valve');
    }
}
