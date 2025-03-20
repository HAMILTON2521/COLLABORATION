<?php

namespace App\Livewire\Customer;

use App\Livewire\Forms\CustomerForm;
use App\Models\Region;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Customer')]
class CreateCustomer extends Component
{
    public CustomerForm $form;

    #[Computed()]
    public function regions()
    {
        return Region::all();
    }

    public function save()
    {
        $customer = $this->form->store();

        if ($customer) {
            $this->form->reset();
            $this->dispatch('showToast', message: 'Customer created successfully', status: 'Success');
        }
    }

    public function render()
    {
        return view('livewire.customer.create-customer');
    }
}
