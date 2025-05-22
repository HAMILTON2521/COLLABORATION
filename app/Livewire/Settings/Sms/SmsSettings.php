<?php

namespace App\Livewire\Settings\Sms;

use App\Models\MessageActivity;
use App\Models\MessageTemplate;
use App\Models\SmsBalance;
use App\Models\SmsSetting;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('SMS Settings')]
class SmsSettings extends Component
{
    public $activeTab = '';

    protected $listeners = [
        'refreshSmsSettings',
        'templateEdited' => 'templateEdited',
        'activityEdited' => 'activityEdited',
    ];

    public function mount()
    {
        $this->activeTab = 'sms';
    }
    public function templateEdited()
    {
        $this->dispatch('showToast', message: 'Template modified successfully', status: 'Success');
    }
    public function activityEdited()
    {
        $this->dispatch('showToast', message: 'Activity modified successfully', status: 'Success');
    }


    public function deleteSmsTemplate(MessageTemplate $template)
    {
        $template->delete();
        $this->dispatch('showToast', message: 'SMS Template deleted successfully', status: 'Success');
    }

    public function checkSmsBalance()
    {
        $baseUrl = SmsSetting::where('key', 'SMS_API_BASE_URL')->first()->value;
        $apiKey = SmsSetting::where('key', 'SMS_API_KEY')->first()->value;
        if ($baseUrl && $apiKey) {
            $balance = SmsBalance::create([
                'status' => 'Pending',
            ]);
            if ($balance) {
                $url = $baseUrl . 'miscapi/' . $apiKey . '/getBalance/true';

                $response = Http::post($url);
                if ($response->successful()) {
                    $data = $response->json()[0];

                    $balance->update([
                        'status' => 'Success',
                        'balance' => $data['BALANCE'],
                        'route_id' => $data['ROUTE_ID'],
                        'route_name' => $data['ROUTE'],
                    ]);
                    $smsBalance = $data['BALANCE'];

                    $this->dispatch('showToast', message: 'The balance is ' . $smsBalance . ' messages.', status: 'Success');
                } else {
                    $balance->update(['status' => 'Failed']);
                    $this->dispatch('showToast', message: 'Failed to retrieve SMS balance', status: 'Error');
                }
            }
        } else {
            $this->dispatch('showToast', message: 'Please set the SMS API base URL and API key in the SMS Settings.', status: 'Error');
            return;
        }
    }
    #[Computed()]
    public function settings()
    {
        return SmsSetting::all();
    }
    #[Computed()]
    public function smsTemplates()
    {
        return MessageTemplate::all();
    }
    #[Computed()]
    public function activities()
    {
        return MessageActivity::all();
    }
    public function render()
    {
        return view('livewire.settings.sms.sms-settings');
    }
}
