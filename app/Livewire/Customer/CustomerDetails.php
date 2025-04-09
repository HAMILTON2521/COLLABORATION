<?php

namespace App\Livewire\Customer;

use App\Livewire\Utils\CustomModal;
use App\Models\Customer;
use App\Models\RealtimeData;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\Log;

#[Title('Customer Details')]
class CustomerDetails extends Component
{
    use HttpHelper;
    public $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function editCustomer()
    {
        $this->redirectRoute('customers.edit', ['customer' => $this->customer->id], navigate: true);
    }
    public function queryRealTimeData()
    {
        $data = $this->customer->realTimeData()->create([
            'source' => 'Manual',
            'user_id' => Auth::id(),
            'status' => 'New',
        ]);
        if ($data) {
            $this->dispatch(
                'showModal',
                payload: [
                    'title' => 'Device ' . $this->customer->imei,
                    'body' => view(
                        'livewire.customer.realtime-data',
                        [
                            'realtime' => RealtimeData::findOrFail($data->id)
                        ]
                    )->render()
                ]

            )->to(CustomModal::class);
        }
    }
    public function dailySettlementRecords()
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'queryDayBillInfo',
            'apiToken' => $api_token,
            'param'   => [
                'deveui'      => $this->customer->imei,
                'billDate' => date('Y-m-d', strtotime('-1 day')),
            ]
        ]);
        $response = $this->sendHttpRequest(data: $data);


        $this->dispatch(
            'showModal',
            payload: [
                'title' => 'Daily Settlement Records',
                'body' => view(
                    'livewire.customer.daily-settlement-records',
                    [
                        'response' => json_encode($response)
                    ]
                )->render()
            ]

        )->to(CustomModal::class);
    }
    public function monthlySettlementRecords()
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'queryMonthBillInfo',
            'apiToken' => $api_token,
            'param'   => [
                'deveui'      => $this->customer->imei,
                'billDate' => date('Y-m-d'),
            ]
        ]);
        $response = $this->sendHttpRequest(data: $data);


        $this->dispatch(
            'showModal',
            payload: [
                'title' => 'Monthly Settlement Records',
                'body' => view(
                    'livewire.customer.monthly-settlement-records',
                    [
                        'response' => json_encode($response)
                    ]
                )->render()
            ]

        )->to(CustomModal::class);
    }
    public function checkBalance()
    {
        //
    }
    public function render()
    {
        return view('livewire.customer.customer-details');
    }
}
