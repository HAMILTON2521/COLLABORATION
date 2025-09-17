<?php

namespace App\Traits;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

trait HttpHelper
{
    public function sendAirtelUssdPush(array $data = [], string $endpoint = ''): array
    {
        $token = $this->getApiToken();

        if (!$token) {
            Log::warning(__FUNCTION__ . ' - Missing API token');
            return [
                'success' => false,
                'error' => 'Missing API token',
            ];
        }

        Log::info(__FUNCTION__, [
            'url' => $endpoint,
            'data' => $data,
            'token' => $token,
        ]);

        try {
            $response = Http::timeout(45)
                ->withToken($token)
                ->withHeaders([
                    'X-Currency' => 'TZS',
                    'X-Country' => 'TZ',
                ])
                ->post($endpoint, $data)
                ->throw();

            return [
                'success' => true,
                'response' => $response,
            ];
        } catch (RequestException $e) {
            Log::error(__FUNCTION__ . ' - HTTP Request Exception', [
                'request' => $data,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        } catch (Throwable $e) {
            Log::error(__FUNCTION__ . ' - General Exception', [
                'request' => $data,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
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
        $api_token = Setting::get('API_TOKEN');
        $areaId = Setting::get('BACKEND_AREA_ID');
        $sysconfigEquipmentId = Setting::get('SYSTEM_CONFIG_EQUIPMENT_ID');

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'getAreaArchives',
            'apiToken' => $api_token,
            'params' => [
                'energyType' => 'LIQUEFIED GAS',
                'pageNumber' => '10',
                'pageSize' => '10',
                'areaId' => $areaId,
                'searchContent' => '',
                'sysconfigEquipmentId' => $sysconfigEquipmentId
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        return $response['values'] ?? [];
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     */
    public function sendHttpRequest(string $data)
    {
        $endpoint = Setting::get('API_BASE_URL');

        $formatedRequestData = [
            'requestParams' => $data
        ];

        Log::info(__FUNCTION__, ['url' => $endpoint, 'data' => $formatedRequestData]);

        $response = Http::asForm()->post(url: $endpoint, data: $formatedRequestData);
        $response->throw();

        return $response->json();
    }

    public function getMeterFileDetails($imei)
    {
        $api_token = Setting::get('API_TOKEN');

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'getAreaArchiveInfo',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $imei,
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        return $response['value'] ?? null;
    }

    public function readDeviceData(string $startDate, string $endDate)
    {
        $api_token = Setting::get('API_TOKEN');
        $areaId = Setting::get('BACKEND_AREA_ID');

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'getMeterReadings',
            'apiToken' => $api_token,
            'params' => [
                'pageNumber' => 1,
                'pageSize' => 10,
                'areaId' => $areaId,
                'energyType' => 'LIQUEFIED GAS',
                'startDate' => Carbon::parse($startDate)->startOfDay()->toDateTimeString(),
                'endDate' => Carbon::parse($endDate)->endOfDay()->toDateTimeString()
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        if ($response && $response['errcode'] == '0') {
            return $response['values'] ?? [];
        } else {
            return [];
        }
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     */
    public function queryValveControlRecords(string $startDate, string $endDate, string $imei)
    {
        $api_token = Setting::get('API_TOKEN');

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'getValverecord',
            'apiToken' => $api_token,
            'param' => [
                'pageNumber' => 1,
                'pageSize' => 10,
                'nbonetNetImei' => $imei,
                'startDate' => Carbon::parse($startDate)->format('Y-m-d'),
                'endDate' => Carbon::parse($endDate)->format('Y-m-d')
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: (string) $data);


            if ($response && $response['errcode'] == '0') {
                return $response['values'] ?? [];
            } else {
                return [];
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
