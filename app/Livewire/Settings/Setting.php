<?php

namespace App\Livewire\Settings;

use App\Models\Setting as ModelsSetting;
use Livewire\Component;

class Setting extends Component
{
    public $key, $value, $type, $description;

    public function mount(ModelsSetting $setting)
    {
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->type = $setting->type;
        $this->description = $setting->description;
    }
    public function render()
    {
        return view('livewire.settings.setting');
    }
}
