<?php

namespace App\Traits;

use App\Models\Setting;
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

        Log::info('Sending http request.', ['url' => $endpoint, 'data' => $formatedRequestData]);

        try {
            $response = Http::asForm()->post(url: $endpoint, data: $formatedRequestData);
            return $response->json();
        } catch (\Throwable $th) {
            Log::error('sendHttpRequest failed', ['exception' => $th->getMessage()]);
            return null;
        }
    }
}
