<?php

namespace App\Livewire\Settings\Sms;

use App\Livewire\Utils\CustomModal;
use App\Models\MessageActivity;
use App\Models\MessageTemplate;
use App\Models\SmsBalance;
use App\Models\SmsSetting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('SMS Settings')]
class SmsSettings extends Component
{
    public string $activeTab = '';

    protected $listeners = [
        'refreshSmsSettings',
        'templateEdited' => 'templateEdited',
        'activityEdited' => 'activityEdited',
    ];

    public function mount(): void
    {
        $this->activeTab = 'sms';
    }

    public function templateEdited(): void
    {
        flash()->success('Template modified successfully');
    }

    public function activityEdited(): void
    {
        flash()->success('Activity modified successfully');
    }
    public function openTestSmsModal()
    {
        $this->dispatch(
            'showModal',
            payload: [
                'title' => 'Test SMS',
                'size' => 'medium',
                'body' => [
                    'component' => TestSms::class,
                    'params' => [],
                ],
                'view' => null,
                'showFooter' => false,
            ]
        )->to(CustomModal::class);

    }


    public function deleteSmsTemplate(MessageTemplate $template): void
    {
        $template->delete();
        flash()->success('SMS Template deleted successfully');
    }

    public function checkSmsBalance(): void
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

                    flash()->success('The balance is ' . $smsBalance . ' messages.');
                } else {
                    $balance->update(['status' => 'Failed']);
                    flash()->error('Failed to retrieve SMS balance');
                }
            }
        } else {
            flash()->error('Please set the SMS API base URL and API key in the SMS Settings.');
            return;
        }
    }

    #[Computed()]
    public function settings(): Collection
    {
        return SmsSetting::all();
    }

    #[Computed()]
    public function smsTemplates(): Collection
    {
        return MessageTemplate::all();
    }

    public function editTemplate($id): void
    {
        $this->dispatch(
            'showModal',
            payload: [
                'title' => 'Edit SMS Template',
                'size' => 'large',
                'body' => [
                    'component' => EditTemplate::class,
                    'params' => ['template' => $id],
                ],
                'view' => null,
                'showFooter' => false,
            ]

        )->to(CustomModal::class);
    }

    #[Computed()]
    public function activities(): Collection
    {
        return MessageActivity::all();
    }

    public function viewSmsSetting($id): void
    {
        $this->dispatch(
            'showModal',
            payload: [
                'title' => 'SMS Setting Details',
                'size' => 'large',
                'body' => null,
                'view' => view('livewire.settings.sms.setting', [
                    'setting' => SmsSetting::findOrFail($id),
                ])->render(),
            ]

        )->to(CustomModal::class);
    }

    public function render()
    {
        return view('livewire.settings.sms.sms-settings');
    }

    public function editSmsSetting($id): void
    {
        $this->dispatch(
            'showModal',
            payload: [
                'title' => 'Edit SMS Setting',
                'size' => 'large',
                'body' => [
                    'component' => Edit::class,
                    'params' => ['setting' => $id],
                ],
                'view' => null,
                'showFooter' => false,
            ]

        )->to(CustomModal::class);
    }
}
