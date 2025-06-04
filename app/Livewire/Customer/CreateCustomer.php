<?php

namespace App\Livewire\Customer;

use App\Models\Region;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\CustomerForm;

#[Title('Create Customer')]
class CreateCustomer extends Component
{
    use WithFileUploads;
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
