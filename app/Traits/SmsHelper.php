<?php

namespace App\Traits;

use App\Models\SmsSetting;
use App\Models\MessageActivity;
use App\Models\MessageTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait SmsHelper
{
    public function sendMessageEnabledFor($activity_name)
    {
        $activity = MessageActivity::where('activity', $activity_name)->first();
        return [
            'canSendSms' => (bool) $activity->send_message,
            'hasTemplate' => $activity->template ? $activity->template->id != null : false,
            'templateId' => $activity ? $activity->message_template_id : null
        ];
    }
    protected function parseTemplate(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = str_replace("{" . $key . "}", $value, $template);
        }

        return $template;
    }
    public function sendNormalSms(string $msg, string $phone): bool
    {
        $baseUrl = SmsSetting::get('SMS_API_BASE_URL');
        $apiKey = SmsSetting::get('SMS_API_KEY');
        $campaign = SmsSetting::get('CAMPAIGN_ID');
        $routeId = SmsSetting::get('ROUTE_ID');
        $senderId = SmsSetting::get('SMS_SENDER_ID');

        if ($baseUrl && $apiKey && $campaign && $routeId && $senderId) {
            info('Msg', ['msg' => $msg]);
            $message = urlencode($msg);
            info('Message', ['message' => $message]);
            $url = $baseUrl . 'smsapi/index.php?key=' . $apiKey . '&campaign=' . $campaign . '&routeid=' . $routeId . '&type=text&contacts=' . $phone . '&senderid=' . $senderId . '&msg=' . $message;
            $response = Http::post($url);

            return $response->successful();
        } else {
            Log::error('Cannot send SMS due to missing configuration for SmsSetting');
            return false;
        }
    }
    public function getTemplate(array $data)
    {
        $sms = $this->sendMessageEnabledFor($data['activity']);
        if ($sms['canSendSms']) {
            if ($sms['hasTemplate']) {
                if ($data['phone']) {
                    $template = MessageTemplate::find($sms['templateId']);
                    $message = $this->parseTemplate($template->body, $data);
                    return $message;
                }
            } else {
                info('SMS not sent, template for ' . $data['activity'] . ' missing');
            }
        }
    }
}
