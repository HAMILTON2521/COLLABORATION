<?php

namespace App\Livewire\Household;

use App\Models\Household;
use App\Models\Setting;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Households')]
class Households extends Component
{
    use HttpHelper;

    public function fetchFromRemote()
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;
        $area_id = Setting::where('key', 'BACKEND_AREA_ID')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'gethousehold',
            'apiToken' => $api_token,
            'params' => [
                'pageNumber' => "1",
                'pageSize' => "10",
                'areaId' => $area_id,
                'searchContent' => ""
            ]
        ]);
        $response = $this->sendHttpRequest(data: $data);

        if ($response['errcode'] === '0') {
            Household::truncate();
            $accounts = $response['values'];
            foreach ($accounts as $account) {
                Household::create([
                    'name' => $account['householdName'],
                    'phone' => $account['phone'],
                    'address' => $account['householdAddress'],
                    'area_id' => $account['areaOrgId'],
                    'serial_number' => $account['serialnumber'],
                    'fee' => $account['householdFee'],
                    'household_number' => $account['id'],
                    'status' => 'Completed',
                ]);
            }
        } else {
            Log::error(
                'gethousehold error',
                [
                    'errcode' => $response['errcode'],
                    'response' => json_encode($response['errmsg'])
                ]
            );
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
