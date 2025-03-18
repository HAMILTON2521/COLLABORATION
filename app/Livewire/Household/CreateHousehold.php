<?php

namespace App\Livewire\Household;

use App\Livewire\Forms\HouseholdForm;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Household')]
class CreateHousehold extends Component
{
    public HouseholdForm $form;

    public function save()
    {
        $response = $this->form->store();
        if ($response->errcode == "0") {
            $this->form->reset();
            $this->dispatch('household-create-success');
        } else {
            $this->dispatch('household-create-failed');
        }
    }
    public function render()
    {
        return view('livewire.household.create-household');
    }
}
