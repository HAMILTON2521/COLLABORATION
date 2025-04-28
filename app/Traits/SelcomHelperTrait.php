<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait SelcomHelperTrait
{
    use SettingsHelper;

    public function computeSignature($parameters, $signedFields, $timestamp): string
    {
        $fieldsOrder = explode(',', $signedFields);
        $signData = "timestamp=$timestamp";

        foreach ($fieldsOrder as $key) {
            $signData .= "&$key=" . $parameters[$key];
        }

        return base64_encode(hash_hmac('sha256', $signData, $this->getSettingValue('SELCOM_API_SECRET'), true));
    }
    public function getSelecomAuth()
    {
        return join(' ', ['SELCOM', base64_encode($this->getSettingValue('SELCOM_API_KEY'))]);
    }
    public function signFields($data)
    {
        return implode(',', array_keys($data));
    }
    public function createMinimumOrder(string $order_id, string $email, string $name, string $phone, int $amount)
    {
        $timestamp = date('c');
        $url = $this->getSettingValue('SELCOM_BASE_URL') . '/checkout/create-order-minimal';

        $order = [
            'vendor' => $this->getSettingValue('SELCOM_VENDOR_ID'),
            'order_id' => $order_id,
            'buyer_email' => $email,
            'buyer_name' => $name,
            'buyer_phone' => $phone,
            'amount' => $amount,
            'currency' => 'TZS',
            'webhook' => $this->getSettingValue('SELCOM_CALLBACK_URL'),
            'no_of_items' => 1,
        ];

        Log::info(__FUNCTION__, ['url' => $url, 'data' => $order]);


        return $this->sendHttpRequest($url, $order, $this->generateHeader($timestamp, $order));
    }
    public function generateHeader($timestamp, $order)
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Timestamp' => $timestamp,
            'Digest-Method' => 'HS256',
            'Authorization' => $this->getSelecomAuth(),
            'Digest' => $this->computeSignature($order, $this->signFields($order), $timestamp),
            'Signed-Fields' => $this->signFields($order),
        ];
    }
    public function sendHttpRequest(string $url, $data = [], $headers = [])
    {
        try {
            $response = Http::withHeaders($headers)
                ->post($url, $data);
            Log::info('Response ' . __FUNCTION__, ['response' => $response->json()]);
            return $response->json();
        } catch (\Throwable $th) {
            Log::error('sendHttpRequest failed', ['exception' => $th->getMessage()]);
            return null;
        }
    }
}
