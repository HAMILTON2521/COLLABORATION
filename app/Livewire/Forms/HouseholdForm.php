<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HouseholdForm extends Form
{
    #[Validate('required|min:2|max:50', as: 'Name')]
    public $name = '';

    #[Validate('required|min:2|max:50', as: 'Address')]
    public $address = '';

    #[Validate('required|size:10', as: 'Phone number')]
    public $phone = '';

    #[Validate('required', as: 'Warn money')]
    public $warn_money = '';

    #[Validate('required', as: 'Fee')]
    public $fee;

    public function store()
    {
        $this->validate();

        $api_token = env('BACKEND_TOKEN');
        $area_id = env('BACKEND_AREA_ID');

        $data = [
            'requestParams' => '{"action":"lorawanMeter","method":"addHousehold","apiToken":"' . $api_token . '","params":{"areaId":"' . $area_id . '","householdName":"' . $this->name . '","householdAddress":"' . $this->address . '","householdPhone":"' . $this->phone . '","householdPassword":"123456","householdWarnMoney":"' . $this->warn_money . '","householdFee":' . $this->fee . '}}'
        ];

        $response = Http::asForm()->post(url: env('BACKEND_ENDPOINT'), data: $data);

        Log::info($response->body());
    }
}
