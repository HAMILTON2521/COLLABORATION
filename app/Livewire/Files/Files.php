<?php

namespace App\Livewire\Files;

use App\Models\Setting;
use App\Traits\HttpHelper;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Get Archive List')]
class Files extends Component
{
    use HttpHelper;

    #[Computed()]
    public function files()
    {
        return $this->getFiles();
    }
    public function render()
    {
        return view('livewire.files.files');
    }
}
