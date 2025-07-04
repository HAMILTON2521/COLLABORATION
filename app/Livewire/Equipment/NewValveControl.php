<?php

namespace App\Livewire\Equipment;


use App\Models\Customer;
use App\Models\ValveControl;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Valve Control')]
class NewValveControl extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public int $perPage = 10;
    public Customer $selectedCustomer;
    public string $valveStatus = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed()]
    public function customers()
    {
        return Customer::latest()->search($this->search)->paginate($this->perPage);
    }

    #[Computed()]
    public function pages(): array
    {
        return [10, 25, 50, 100];
    }

    public function setCustomer(Customer $customer): void
    {
        $this->selectedCustomer = $customer;
    }

    public function sendCommand(): void
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
            if ($command->error_code == '0') {
                flash()->success('Valve control command sent ' . $command->error_message);

                $this->redirectRoute('more.equipment.valve.details', ['valve' => $command->id]);
            } else {
                flash()->error($command->error_message);
            }

        }
    }

    public function resetCustomer(): void
    {
        $this->reset('selectedCustomer', 'valveStatus');
    }

    public function render()
    {
        return view('livewire.equipment.new-valve-control');
    }
}
