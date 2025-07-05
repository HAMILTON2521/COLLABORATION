<?php

namespace App\Livewire\Data;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Data Query')]
class DataQuery extends Component
{
    public function queryRealTimeData(): void
    {
        sleep(2);
    }

    public function render()
    {
        return view('livewire.data.data-query');
    }
}
