<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Customers')]
class Customers extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public int $perPage = 10;

    public function delete(Customer $customer): void
    {
        $customer->delete();
        flash()->success('Customer deleted successfully');
    }

    // Reset pagination when search query changes
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function customers()
    {
        return Customer::latest()->search($this->search)->paginate($this->perPage);
    }

    #[Computed()]
    public function pages(): array
    {
        return [10, 25, 50, 100];
    }

    public function render()
    {
        return view('livewire.customer.customers');
    }
}
