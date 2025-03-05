<?php

namespace App\Livewire\Household;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Household')]
class CreateHousehold extends Component
{
    public function render()
    {
        return view('livewire.household.create-household');
    }
}
