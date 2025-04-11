<?php

namespace App\Livewire\Equipment;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Equipment')]
class Equipment extends Component
{
    public function batteryCommand()
    {
        $this->redirectRoute('more.equipment.battery.command');
    }
    public function statusCommand()
    {
        $this->redirectRoute('more.equipment.status.command');
    }
    public function render()
    {
        return view('livewire.equipment.equipment');
    }
}
