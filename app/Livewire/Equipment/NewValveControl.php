<?php

namespace App\Livewire\Equipment;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('New Valve Control')]
class NewValveControl extends Component
{
    public function render()
    {
        return view('livewire.equipment.new-valve-control');
    }
}
