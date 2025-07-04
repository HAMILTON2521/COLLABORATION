<?php

namespace App\Livewire\Customer;

use App\Models\Region as ModelsRegion;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Region')]
class Region extends Component
{
    public ModelsRegion $region;

    public function mount(ModelsRegion $region): void
    {
        $this->region = $region;
    }
    public function render()
    {
        return view('livewire.customer.region');
    }
}
