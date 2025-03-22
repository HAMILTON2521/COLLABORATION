<?php

namespace App\Livewire\Household;

use App\Models\Household;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Households')]
class Households extends Component
{
    public function fetchFromRemote()
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
    }
    #[Computed()]
    public function accounts()
    {
        return Household::with('createdBy')->orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.household.households');
    }
}
