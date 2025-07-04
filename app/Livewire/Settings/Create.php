<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Create extends Component
{
    public string $key = '';
    public string $value = '';
    public string $type = '';
    public string $description = '';

    public function save(): void
    {
        $this->validate([
            'key' => 'required|string|max:255|unique:settings',
            'value' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Setting::create([
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
            'description' => $this->description,
        ]);

        $this->dispatch('hideModal');
        $this->dispatch('refreshSettings');
        flash()->success('New setting created successfully');
    }

    public function render()
    {
        return view('livewire.settings.create');
    }
}
