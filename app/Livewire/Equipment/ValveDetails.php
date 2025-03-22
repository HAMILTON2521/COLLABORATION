<?php

namespace App\Livewire\Equipment;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Valve Control Details')]
class ValveDetails extends Component
{
    public function render()
    {
        return view('livewire.equipment.valve-details');
    }
}
