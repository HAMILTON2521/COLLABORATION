<?php

namespace App\Livewire\Settings\Sms;

use App\Models\SmsSetting;
use Livewire\Component;

class Setting extends Component
{
    public $key, $value, $type, $description;

    public function mount(SmsSetting $setting)
    {
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->type = $setting->type;
        $this->description = $setting->description;
    }
    public function render()
    {
        return view('livewire.settings.sms.setting');
    }
}
