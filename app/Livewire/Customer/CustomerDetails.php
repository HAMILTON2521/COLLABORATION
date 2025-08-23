<?php

namespace App\Livewire\Customer;

use App\Livewire\Utils\CustomModal;
use App\Models\Customer;
use App\Models\RealtimeData;
use App\Models\Setting;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Customer Details')]
class CustomerDetails extends Component
{
    use HttpHelper;

    public $customer;

    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function editCustomer(): void
    {
        $this->redirectRoute('customers.edit', ['customer' => $this->customer->id], navigate: true);
    }

    public function queryRealTimeData(): void
    {
        $data = $this->customer->realTimeData()->create([
            'source' => 'Manual',
            'user_id' => Auth::id(),
            'status' => 'New',
        ]);
        if ($data) {
            if ($data->status === 'Failed') {
                flash()->error($data->error_message);
                return;
            }
            $this->dispatch(
                'showModal',
                payload: [
                    'title' => 'Device ' . $this->customer->imei,
                    'size' => 'large',
                    'body' => null,
                    'view' => view(
                        'livewire.customer.realtime-data',
                        [
                            'realtime' => RealtimeData::findOrFail($data->id)
                        ]
                    )->render()
                ]

            )->to(CustomModal::class);
        }
    }

    public function render()
    {
        return view('livewire.customer.customer-details');
    }

    public function getValveStatus(): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'readValveStatus',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $this->customer->imei
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: $data);

            $this->dispatch(
                'showModal',
                payload: [
                    'title' => 'Valve Status',
                    'body' => null,
                    'view' => view(
                        'livewire.equipment.valve-status',
                        [
                            'response' => $response
                        ]
                    )->render()
                ]

            )->to(CustomModal::class);
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function dailySettlementRecords(): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'queryDayBillInfo',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $this->customer->imei,
                'billDate' => date('Y-m-d', strtotime('-1 day')),
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: $data);


            $this->dispatch(
                'showModal',
                payload: [
                    'title' => 'Daily Settlement Records',
                    'body' => null,
                    'view' => view(
                        'livewire.customer.daily-settlement-records',
                        [
                            'response' => json_encode($response)
                        ]
                    )->render()
                ]

            )->to(CustomModal::class);
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function getMeterFile(): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'getAreaArchiveInfo',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $this->customer->imei,
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: $data);

            $this->dispatch(
                'showModal',
                payload: [
                    'title' => 'Meter File',
                    'size' => 'large',
                    'body' => null,
                    'view' => view(
                        'livewire.customer.meter-file',
                        [
                            'response' => $response
                        ]
                    )->render()
                ]

            )->to(CustomModal::class);
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function changeValveState(): void
    {
        $this->dispatch('changeValveState', customer: $this->customer->id);
    }

    public function monthlySettlementRecords(): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'queryMonthBillInfo',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $this->customer->imei,
                'billDate' => date('Y-m-d'),
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: $data);


            $this->dispatch(
                'showModal',
                payload: [
                    'title' => 'Monthly Settlement Records',
                    'body' => null,
                    'view' => view(
                        'livewire.customer.monthly-settlement-records',
                        [
                            'response' => json_encode($response)
                        ]
                    )->render()
                ]

            )->to(CustomModal::class);
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function checkBalance()
    {
        //
    }
}
