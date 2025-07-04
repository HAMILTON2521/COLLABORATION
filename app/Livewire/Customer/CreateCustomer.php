<?php

namespace App\Livewire\Customer;

use App\Livewire\Forms\CustomerForm;
use App\Models\Region;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    public function save(): void
    {
        $customer = $this->form->store();

        if ($customer) {
            $this->form->reset();
            flash()->success('Customer created successfully');
        }
    }

    public function render()
    {
        return view('livewire.customer.create-customer');
    }
}
