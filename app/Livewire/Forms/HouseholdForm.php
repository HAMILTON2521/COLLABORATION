<?php

namespace App\Livewire\Forms;

use App\Models\Household;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HouseholdForm extends Form
{
    #[Validate('required|string|max:255', as: 'name')]
    public $name = '';

    #[Validate('required|string|max:255', as: 'address')]
    public $address = '';

    #[Validate('required|size:10', as: 'phone number')]
    public $phone = '';

    #[Validate('nullable|integer|min:0', as: 'warn money')]
    public $warn_money = 0;

    #[Validate('nullable|integer|min:0', as: 'fee')]
    public $fee = 0;

    public $password = '123456';

    public function store()
    {
        $validData = $this->validate();

        $household = Household::create([
            'name' => $validData['name'],
            'address' => $validData['address'],
            'fee' => $validData['fee'] ?? null,
            'warn_money' => $validData['warn_money'] ?? null,
            'created_by' => Auth::user()->id,
            'password' => Hash::make($this->password),
            'phone' => $validData['phone']
        ]);

        if ($household) {
            $api_token = env('BACKEND_TOKEN');
            $area_id = env('BACKEND_AREA_ID');

            $data = [
                'requestParams' => '{"action":"lorawanMeter","method":"addHousehold","apiToken":"' . $api_token . '","params":{"areaId":"' . $area_id . '","householdName":"' . $household->name . '","householdAddress":"' . $household->address . '","householdPhone":"' . $household->phone . '","householdPassword":' . $this->password . ',"householdWarnMoney":"' . $household->warn_money . '","householdFee":' . $household->fee . '}}'
            ];

            $response = Http::asForm()->post(url: env('BACKEND_ENDPOINT'), data: $data);

            $json = json_decode($response);
            if ($json->errcode == "0") {
                $household->update(['status' => 'completed']);
            }
            return $json;
        }
    }
}
