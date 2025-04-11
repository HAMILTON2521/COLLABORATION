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
        $household = $this->form->store();
        if ($household) {
            $this->form->reset();
            $this->dispatch('household-create-success');
        }
    }
    public function render()
    {
        return view('livewire.household.create-household');
    }
}
