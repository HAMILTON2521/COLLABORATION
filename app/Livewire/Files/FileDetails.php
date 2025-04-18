<?php

namespace App\Livewire\Files;

use App\Models\Setting;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Meter File Details')]
class FileDetails extends Component
{
    use HttpHelper;
    public $file;

    public function mount($imei)
    {
        $this->file = $this->getMeterFileDetails($imei);
    }

    public function render()
    {
        return view('livewire.files.file-details');
    }
}
