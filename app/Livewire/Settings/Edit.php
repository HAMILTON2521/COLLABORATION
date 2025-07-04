<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $setting;

    public string $key = '';
    public string $value = '';
    public string $type = '';
    public string $description = '';

    public function edit(): void
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
            'description' => $this->description ?? null,
        ]);

        $this->dispatch('hideModal');
        $this->dispatch('refreshSettings');

        flash()->success('Setting updated successfully');
    }

    public function mount($id): void
    {
        $setting = Setting::findOrFail($id);

        $this->setting = $setting;
        $this->key = $setting->key;
        $this->value = $setting->value;
        $this->type = $setting->type ?? '';
        $this->description = $setting->description ?? '';
    }

    public function render()
    {
        return view('livewire.settings.edit');
    }
}
