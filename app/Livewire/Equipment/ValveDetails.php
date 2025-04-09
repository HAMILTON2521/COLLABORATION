<?php

namespace App\Livewire\Equipment;

use App\Models\ValveControl;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Valve Control Details')]
class ValveDetails extends Component
{
    public ValveControl $valveControl;

    public function mount(ValveControl $valve)
    {
        $this->valveControl = $valve;
    }
    public function render()
    {
        return view('livewire.equipment.valve-details', [
            'valveControl' => $this->valveControl,
        ]);
    }
}
