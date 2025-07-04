<?php

namespace App\Livewire\Settings;

use App\Models\Setting as ModelsSetting;
use Livewire\Component;

class Setting extends Component
{
    public string $key = '';
    public string $value = '';
    public string $type = '';
    public string $description = '';
    public string $updated_at = '';

    public function mount($id): void
    {
        $setting = ModelsSetting::find($id);

        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->type = $setting->type;
        $this->description = $setting->description ?? '';
        $this->updated_at = $setting->updated_at->diffForHumans();
    }

    public function render()
    {
        return view('livewire.settings.setting');
    }
}
