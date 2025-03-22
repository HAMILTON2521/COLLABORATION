<?php

namespace App\Livewire\Equipment;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Equipment')]
class Equipment extends Component
{
    public function render()
    {
        return view('livewire.equipment.equipment');
    }
}
