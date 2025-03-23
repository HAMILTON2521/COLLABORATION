<?php

namespace App\Livewire\Customer;

use App\Models\RealtimeData;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class RealTimeDataModal extends Component
{
    public $id;
    public RealtimeData $realtime;

    #[On('real-time-data-created')]
    public function getRealtimeData($id)
    {
        $data = RealtimeData::findOrFail($id);
        $this->realtime = $data;

        $this->dispatch('showRealtimeDataModal');
    }

    public function render()
    {
        return view('livewire.customer.real-time-data-modal');
    }
}
