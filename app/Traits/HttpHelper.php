<?php

namespace App\Traits;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait HttpHelper
{
    public function sendHttpRequest(string $data)
    {
        $endpoint = Setting::where('key', 'API_BASE_URL')->first()->value;

        $formatedRequestData = [
            'requestParams' =>  $data
        ];

        Log::info(__FUNCTION__, ['url' => $endpoint, 'data' => $formatedRequestData]);

        try {
            $response = Http::asForm()->post(url: $endpoint, data: $formatedRequestData);
            //Log::info('Response ' . __FUNCTION__, ['response' => $response->json()]);
            return $response->json();
        } catch (\Throwable $th) {
            Log::error('sendHttpRequest failed', ['exception' => $th->getMessage()]);
            return null;
        }
    }
    public function sendAirtelUssdPush($data = [], $endpoint = '')
    {
        $token = $this->getApiToken();

        if (!$token) {
            return null;
        }

        Log::info(__FUNCTION__, [
            'url' => $endpoint,
            'data' => json_encode($data),
            'token' => $token
        ]);

        try {
            $response = Http::timeout(45)
                ->withToken($token)
                ->withHeaders([
                    'X-Currency' => 'TZS',
                    'X-Country' => 'TZ',
                ])->post($endpoint, $data)->throw();
            return $response;
        } catch (RequestException $e) {
            Log::error(__FUNCTION__ . ' - HTTP Request Exception', [
                'request' => json_encode($data),
                'code' => $e->getCode(),
                'exception' => $e->getMessage()
            ]);
            return null;
        } catch (\Exception $e) {
            Log::error(__FUNCTION__ . ' - General Exception', [
                'request' => json_encode($data),
                'code' => $e->getCode(),
                'exception' => $e->getMessage()
            ]);
            return null;
        }
    }

    public function getApiToken()
    {
        $url = Setting::where('key', App::environment('production') ? 'AIRTEL_C2B_PROD_USSD_PUSH_URL' : 'AIRTEL_C2B_UAT_USSD_PUSH_URL')->first()->value;
        $clientId = Setting::where('key', App::environment('production') ? 'AIRTEL_PROD_CLIENT_ID' : 'AIRTEL_UAT_CLIENT_ID')->first()->value;
        $clientSecret = Setting::where('key', App::environment('production') ? 'AIRTEL_PROD_CLIENT_SECRET_KEY' : 'AIRTEL_UAT_CLIENT_SECRET_KEY')->first()->value;

        $endPoint = $url . 'auth/oauth2/token';

        $response = Http::post($endPoint, [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'client_credentials'
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        } else {
            return null;
        }
    }
    public function getFiles()
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;
        $areaId = Setting::where('key', 'BACKEND_AREA_ID')->first()->value;
        $sysconfigEquipmentId = Setting::where('key', 'SYSTEM_CONFIG_EQUIPMENT_ID')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'getAreaArchives',
            'apiToken' => $api_token,
            'params'   => [
                'energyType' => 'LIQUEFIED GAS',
                'pageNumber' => '10',
                'pageSize' => '10',
                'areaId'      => $areaId,
                'searchContent' => '',
                'sysconfigEquipmentId' => $sysconfigEquipmentId
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        return $response['values'] ?? [];
    }
    public function getMeterFileDetails($imei)
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'getAreaArchiveInfo',
            'apiToken' => $api_token,
            'param'   => [
                'deveui' => $imei,
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        return $response['value'] ?? null;
    }
    public function readDeviceData(string $startDate, string $endDate)
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;
        $areaId = Setting::where('key', 'BACKEND_AREA_ID')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'getMeterReadings',
            'apiToken' => $api_token,
            'params'   => [
                'pageNumber' => 1,
                'pageSize' => 10,
                'areaId' => $areaId,
                'energyType' => 'LIQUEFIED GAS',
                'startDate' => Carbon::parse($startDate)->startOfDay()->toDateTimeString(),
                'endDate' => Carbon::parse($endDate)->endOfDay()->toDateTimeString()
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        if ($response  && $response['errcode'] == '0') {
            return $response['values'] ?? [];
        } else {
            return [];
        }
    }
}
