<?php

namespace App\Livewire\Settings;

use App\Livewire\Forms\Settings\CreateForm;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Settings')]
class Settings extends Component
{
    public $activeTab = '';
    public Setting $selectedSetting;
    public CreateForm $form;



    public function mount()
    {
        $this->activeTab = 'system';
    }
    #[Computed()]
    public function settings()
    {
        return Setting::latest()->get();
    }
    public function changeValue(Setting $setting)
    {
        $this->selectedSetting = $setting;
    }
    public function save()
    {
        $setting = $this->form->store();

        if ($setting) {
            $this->form->reset();
            $this->dispatch('showToast', message: 'New setting created successfully', status: 'Success');
        }
    }
    public function delete(Setting $setting)
    {
        $setting->delete();
        $this->dispatch('showToast', message: 'Setting deleted successfully', status: 'Success');
    }
    public function render()
    {
        return view('livewire.settings.settings');
    }
}
