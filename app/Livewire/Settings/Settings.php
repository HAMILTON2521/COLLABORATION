<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Settings')]
class Settings extends Component
{
    public $activeTab = '';

    public function mount()
    {
        $this->activeTab = 'system';
    }
    public function render()
    {
        return view('livewire.settings.settings');
    }
}
