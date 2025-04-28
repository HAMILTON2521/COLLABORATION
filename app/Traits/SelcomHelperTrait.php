<?php

namespace App\Traits;

use App\Models\SelcomOrder;
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
    public function createMinimumOrder(SelcomOrder $selcomOrder)
    {
        $url =  '/checkout/create-order-minimal';

        $order = [
            'vendor' => $this->getSettingValue('SELCOM_VENDOR_ID'),
            'order_id' => $selcomOrder->id,
            'buyer_email' => $selcomOrder->customer->account->user->email,
            'buyer_name' => $selcomOrder->customer->full_name,
            'buyer_phone' => $selcomOrder->phone,
            'amount' => $selcomOrder->amount,
            'currency' => 'TZS',
            'webhook' => base64_encode($this->getSettingValue('SELCOM_CALLBACK_URL')),
            'no_of_items' => 1,
        ];

        Log::info(__FUNCTION__, ['url' => $url, 'data' => $order]);


        return $this->sendHttpRequest($url, $order, $this->generateHeader(date('c', strtotime($selcomOrder->created_at)), $order));
    }
    public function c2b(SelcomOrder $selcomOrder)
    {
        $url =  '/checkout/wallet-payment';

        $order = [
            'transid' => $selcomOrder->id,
            'order_id' => $selcomOrder->id,
            'msisdn' => $selcomOrder->phone,
        ];
        Log::info(__FUNCTION__, ['url' => $url, 'data' => $order]);

        return $this->sendHttpRequest($url, $order, $this->generateHeader(date('c', strtotime($selcomOrder->created_at)), $order));
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
        $baseUrl = $this->getSettingValue('SELCOM_BASE_URL');
        try {
            $response = Http::withHeaders($headers)
                ->post($baseUrl . $url, $data);
            Log::info('Response ' . __FUNCTION__, ['response' => $response->json()]);
            return $response->json();
        } catch (\Throwable $th) {
            Log::error('sendHttpRequest failed', ['exception' => $th->getMessage()]);
            return null;
        }
    }
}
