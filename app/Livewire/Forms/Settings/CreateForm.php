<?php

namespace App\Livewire\Forms\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{
    #[Validate('required|unique:settings')]
    public $key;

    #[Validate('required')]
    public $value;

    #[Validate('required|string')]
    public $type;

    #[Validate('nullable|string')]
    public $description;


    public function store()
    {
        $validData = $this->validate();
        return Setting::create([
            'key' => $validData['key'],
            'value' => $validData['value'],
            'type' => $validData['type'],
            'description' => $validData['description'],
            'created_by' => Auth::user()->id
        ]);
    }
}
