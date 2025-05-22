<?php

namespace App\Traits;

use App\Models\MessageActivity;
use App\Models\SmsSetting;

trait SmsHelper
{
    public function getConfig($key)
    {
        return SmsSetting::where('key', $key)->first()->value;
    }
    public function sendMessageEnabledFor($activity_name)
    {
        $activity = MessageActivity::where('activity', $activity_name)->first();
        return [
            'canSendSms' => (bool) $activity->send_message,
            'hasTemplate' => $activity->template->id != null,
            'templateId' => $activity->template->id,
        ];
    }
    protected function parseTemplate(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = str_replace("{" . $key . "}", $value, $template);
        }

        return $template;
    }
}
