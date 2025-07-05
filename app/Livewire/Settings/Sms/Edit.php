<?php

namespace App\Livewire\Settings\Sms;

use App\Models\SmsSetting;
use Livewire\Component;

class Edit extends Component
{
    public $setting;
    public string $key = '';
    public string $value = '';
    public string $type = '';
    public string $description = '';

    public function mount(SmsSetting $setting): void
    {
        $this->setting = $setting;
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->type = $setting->type;
        $this->description = $setting->description ?? '';
    }

    public function edit(): void
    {
        $this->validate([
            'value' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $this->setting->update([
            'value' => $this->value,
            'type' => $this->type,
            'description' => $this->description ?? null,
        ]);

        $this->dispatch('hideModal');
        $this->dispatch('refreshSmsSettings');

        flash()->success('SMS setting updated successfully');
    }

    public function render()
    {
        return view('livewire.settings.sms.edit');
    }
}
