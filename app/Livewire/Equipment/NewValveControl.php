<?php

namespace App\Livewire\Equipment;

use App\Livewire\Utils\CustomModal;
use App\Models\Customer;
use App\Models\ValveControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Valve Control')]
class NewValveControl extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $perPage = 10;
    public Customer $selectedCustomer;
    public $valveStatus = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[Computed()]
    public function customers()
    {
        return Customer::latest()->search($this->search)->paginate($this->perPage);
    }
    #[Computed()]
    public function pages()
    {
        return [10, 25, 50, 100];
    }
    public function setCustomer(Customer $customer)
    {
        $this->selectedCustomer = $customer;
    }
    public function sendCommand()
    {
        $validData = $this->validate([
            'valveStatus' => 'required|in:open,close',
        ]);

        $command = ValveControl::create([
            'source' => 'Manual',
            'user_id' => Auth::id(),
            'state' => $validData['valveStatus'] == 'open' ? 1 : 0,
            'customer_id' => $this->selectedCustomer->id,
        ]);
        if ($command) {
            session()->flash('success', 'Valve control command sent ' . $command->error_message);

            $this->redirectRoute('more.equipment.valve.details', ['valve' => $command->id]);
        }
    }
    public function resetCustomer()
    {
        $this->reset('selectedCustomer', 'valveStatus');
    }
    public function render()
    {
        return view('livewire.equipment.new-valve-control');
    }
}
