<?php

namespace App\Livewire\Household;

use App\Livewire\Forms\HouseholdForm;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;

#[Title('Households')]
class Households extends Component
{
    public HouseholdForm $form;

    public function save()
    {
        $this->form->store();
        $this->form->reset();

        $this->redirectRoute('accounts');
    }
    public function render()
    {
        $accounts = [];
        $api_token = env('BACKEND_TOKEN');
        $area_id = env('BACKEND_AREA_ID');
        $data = [
            'requestParams' => '{ "action":"lorawanMeter", "method":"gethousehold", "apiToken":"' . $api_token . '","params":{ "pageNumber":"1", "pageSize":"10", "areaId":"' . $area_id . '","searchContent":""}}'
        ];

        $response = Http::asForm()->post(url: env('BACKEND_ENDPOINT'), data: $data);

        if ($response->status() == 200) {
            $json = $response->json();
            $accounts = $json['values'];
        } else {
            Log::error('gethousehold failed with error {error}', ['error' => $response->status()]);
        }
        return view('livewire.household.households', [
            'status' => $response->status(),
            'accounts' => $accounts
        ]);
    }
}
