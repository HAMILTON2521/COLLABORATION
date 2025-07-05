<?php

namespace App\Livewire\Settings\Sms;

use App\Models\MessageTemplate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditTemplate extends Component
{
    public $template;
    public string $title = '';
    public string $description = '';
    public string $body = '';
    public string $icon = '';
    public $placeholders;

    public function mount(MessageTemplate $template): void
    {
        $this->template = $template;
        $this->title = $template->title ?? '';
        $this->description = $template->description ?? '';
        $this->body = $template->body ?? '';
        $this->icon = $template->ti_icon ?? '';
        $this->placeholders = $template->placeholders;
    }

    public function edit(): void
    {
        $this->validate([
            'title' => ['required', Rule::unique('message_templates')->ignore($this->template->id),],
            'placeholders' => 'required',
            'body' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);
        $update = $this->template->update([
            'title' => $this->title,
            'body' => $this->body,
            'ti_icon' => $this->icon ?? 'ti-message-check',
            'description' => $this->description,
            'placeholders' => $this->placeholders
        ]);

        if ($update) {
            $this->reset(['title', 'body', 'icon', 'placeholders', 'description']);
        }
        $this->dispatch('templateEdited');
        $this->dispatch('hideModal');

        flash()->success('Template updated successfully.');
    }

    public function render()
    {
        return view('livewire.settings.sms.edit-template');
    }
}
