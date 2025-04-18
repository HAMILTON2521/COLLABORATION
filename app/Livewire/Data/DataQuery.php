<?php

namespace App\Livewire\Data;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Data Query')]
class DataQuery extends Component
{
    public function render()
    {
        return view('livewire.data.data-query');
    }
}
