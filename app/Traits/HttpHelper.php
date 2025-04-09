<?php

namespace App\Traits;

use App\Models\Setting;
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
}
