<?php

namespace App\Livewire\Settings;


use App\Livewire\Utils\CustomModal;
use App\Models\Setting;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Settings')]
class Settings extends Component
{
    public string $activeTab = '';

    protected $listeners = ['refreshSettings'];

    public function openModal($action, $setting = null): void
    {
        $map = [
            'create' => [
                'title' => 'Add New Setting',
                'component' => Create::class,
            ],
            'edit' => [
                'title' => 'Edit Setting',
                'component' => Edit::class,
            ],
            'view' => [
                'title' => 'Setting Details',
                'component' => \App\Livewire\Settings\Setting::class,
            ],
        ];

        // Fallback to prevent undefined index (optional)
        $selected = $map[$action] ?? [
            'title' => 'Unknown Action',
            'component' => null,
        ];

        $this->dispatch(
            'showModal',
            payload: [
                'title' => $selected['title'],
                'size' => 'large',
                'body' => [
                    'component' => $selected['component'],
                    'params' => ['id' => $setting],
                ],
                'view' => null,
                'showFooter' => false,
            ]
        )->to(CustomModal::class);
    }

    public function mount(): void
    {
        $this->activeTab = 'system';
    }

    public function render()
    {
        return view('livewire.settings.settings');
    }

    public function save()
    {
        $data = $this->form->store();
        if ($data) {
            flash()->success("Data saved successfully");
        }
    }

    #[Computed()]
    public function settings()
    {
        return Setting::latest()->get();
    }
}
