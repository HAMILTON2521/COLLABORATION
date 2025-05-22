<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $setting;
    public $key, $value, $type, $description;

    public function mount(Setting $setting)
    {
        $this->setting = $setting;
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->type = $setting->type;
        $this->description = $setting->description;
    }

    public function edit()
    {
        $this->validate([
            'key' => [
                'required',
                Rule::unique('settings')->ignore($this->setting->id),
            ],
            'value' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $this->setting->update([
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
            'description' => $this->description,
        ]);

        $this->dispatch('hideModal');
        $this->dispatch('refreshSettings');

        $this->dispatch('showToast', message: 'New setting updated successfully', status: 'Success');
    }

    public function render()
    {
        return view('livewire.settings.edit');
    }
}
