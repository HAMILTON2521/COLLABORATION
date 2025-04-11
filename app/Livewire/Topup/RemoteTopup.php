<?php

namespace App\Livewire\Topup;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

#[Title('Remote Topup')]
class RemoteTopup extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $perPage = 10;

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
    public function topup(Customer $customer)
    {
        $this->redirectRoute('topup.payment.recharge', ['customer' => $customer->id]);
    }
    public function render()
    {
        return view('livewire.topup.remote-topup');
    }
}
