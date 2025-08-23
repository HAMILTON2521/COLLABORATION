<?php

namespace App\Livewire\Equipment;

use App\Livewire\Utils\CustomModal;
use App\Models\Customer;
use App\Models\Setting;
use App\Traits\HttpHelper;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Battery Command')]
class BatteryCommand extends Component
{
    use WithPagination, WithoutUrlPagination, HttpHelper;

    public string $search = '';
    public int $perPage = 10;
    public Customer $selectedCustomer;
    public string $valveStatus = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed()]
    public function customers()
    {
        return Customer::latest()->search($this->search)->paginate($this->perPage);
    }

    #[Computed()]
    public function pages(): array
    {
        return [10, 25, 50, 100];
    }

    public function sendCommand(): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'sendCommand',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $this->selectedCustomer->imei,
                'commandStr' => 'queryBattery',
                'commandParams' => [],
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: (string)$data);
            if ($response['errcode'] == '-1') {
                $this->dispatch('showToast', message: 'Command queryBattery failed with error ' . $response['errmsg'], status: 'Failed');
            } else {
                $data = json_encode([
                    'action' => 'zlMeter',
                    'method' => 'queryCommandInfo',
                    'apiToken' => $api_token,
                    'param' => [
                        'valueId' => $response['valueId'],
                    ]
                ]);

                $response = $this->sendHttpRequest(data: (string)$data);
                if ($response['errcode'] == '-1') {
                    $this->dispatch('showToast', message: 'Command queryBattery failed with error ' . $response['errmsg'], status: 'Failed');
                } else {
                    info(json_encode($response));
                    $this->dispatch(
                        'showModal',
                        payload: [
                            'title' => 'Battery Command Result',
                            'body' => null,
                            'view' => view(
                                'livewire.equipment.battery-command-result',
                                [
                                    'response' => json_encode($response)
                                ]
                            )->render()
                        ]

                    )->to(CustomModal::class);
                }
            }
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.equipment.battery-command');
    }

    public function setCustomer(Customer $customer): void
    {
        $this->selectedCustomer = $customer;
    }

    public function resetCustomer(): void
    {
        $this->reset('selectedCustomer');
    }
}
