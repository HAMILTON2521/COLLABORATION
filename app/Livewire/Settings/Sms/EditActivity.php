<?php

namespace App\Livewire\Settings\Sms;

use App\Models\MessageActivity;
use App\Models\MessageTemplate;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

class EditActivity extends Component
{
    public $activity;
    public $title, $sendMessage, $description;
    public $templateId = '';

    public function mount(MessageActivity $activity)
    {
        $this->activity = $activity;

        $this->title = $activity->activity;
        $this->description = $activity->description;
        $this->templateId = $activity->message_template_id;
        $this->sendMessage = (bool) $activity->send_message;
    }
    #[Computed()]
    public function templates()
    {
        return MessageTemplate::orderBy('title', 'asc')->get();
    }

    public function edit()
    {
        $this->validate([
            'description' => 'nullable|string',
            'templateId' => 'nullable|exists:message_templates,id',
            'sendMessage' => 'nullable|boolean'
        ]);

        $update = $this->activity->update([
            'activity' => $this->title,
            'description' => $this->description ?? null,
            'message_template_id' => $this->templateId ?? null,
            'send_message' => $this->sendMessage,
        ]);

        if ($update) {
            $this->reset(['title', 'description', 'sendMessage', 'templateId']);

            $this->dispatch('hideModal');
            $this->dispatch('activityEdited');
        }
    }
    public function render()
    {
        return view('livewire.settings.sms.edit-activity');
    }
}
