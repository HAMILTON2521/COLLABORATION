<?php

namespace App\Livewire\Files;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('New Meter File')]
class AddMeterFile extends Component
{
    public function render()
    {
        return view('livewire.files.add-meter-file');
    }
}
