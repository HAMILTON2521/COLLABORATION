<?php

namespace App\Livewire\Settings;

use App\Livewire\Forms\Settings\CreateForm;
use App\Models\MessageTemplate;
use App\Models\Setting;
use App\Models\SmsBalance;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Settings')]
class Settings extends Component
{
    public $activeTab = '';
    public CreateForm $form;


    protected $listeners = ['refreshSettings'];

    public function mount()
    {
        $this->activeTab = 'system';
    }
    #[Computed()]
    public function settings()
    {
        return Setting::latest()->get();
    }
    public function render()
    {
        return view('livewire.settings.settings');
    }
}
