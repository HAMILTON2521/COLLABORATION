<?php

namespace App\Livewire\Settings\Sms;

use Livewire\Component;
use App\Models\SmsSetting;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;

class TestSms extends Component
{
    #[Validate('required|integer|starts_with:255')]
    public $phone;
    #[Validate('required|string')]
    public $message = 'Testing if SMS is working.';
    #[Validate('required|in:text,flash')]
    public $type = 'text';

    public function testSms()
    {
        $this->validate();
        $baseUrl = SmsSetting::where('key', 'SMS_API_BASE_URL')->first()->value;
        $apiKey = SmsSetting::where('key', 'SMS_API_KEY')->first()->value;
        $campaign = SmsSetting::where('key', 'CAMPAIGN_ID')->first()->value;
        $routeId = SmsSetting::where('key', 'ROUTE_ID')->first()->value;
        $senderId = SmsSetting::where('key', 'SMS_SENDER_ID')->first()->value;


        if ($baseUrl && $apiKey && $campaign && $routeId && $senderId) {
            $message = urlencode($this->message);
            $url = $baseUrl . 'smsapi/index.php?key=' . $apiKey . '&campaign=' . $campaign . '&routeid=' . $routeId . '&type=' . $this->type . '&contacts=' . $this->phone . '&senderid=' . $senderId . '&msg=' . $message;
            $response = Http::post($url);

            if ($response->successful()) {
                $this->reset(['phone', 'message', 'type']);

                $this->dispatch('showToast', message: 'Sent!. Check if you received it.', status: 'Success');
            } else {
                $this->dispatch('showToast', message: 'Failed to send test SMS', status: 'Error');
            }
        } else {
            $this->dispatch('showToast', message: 'Please configure sms settings in the SMS Settings section.', status: 'Error');
            return;
        }
    }

    public function render()
    {
        return view('livewire.settings.sms.test-sms');
    }
}
