<?php

namespace App\Livewire\Settings\Sms;

use App\Models\MessageActivity;
use App\Models\MessageTemplate;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AssignTemplate extends Component
{
    public $activity;

    public $templateId;

    public function mount(MessageActivity $activity)
    {
        $this->activity = $activity;
        $this->templateId = $activity->message_template_id;
    }

    public function assign()
    {
        $this->validate([
            'templateId' => 'required|exists:message_templates,id'
        ]);

        $this->activity->update(['message_template_id' => $this->templateId]);
        $this->reset('templateId');

        $this->dispatch('hideModal');
        $this->dispatch('activityEdited');
    }

    #[Computed()]
    public function templates()
    {
        return MessageTemplate::orderBy('title', 'asc')->get();
    }
    public function render()
    {
        return view('livewire.settings.sms.assign-template');
    }
}
