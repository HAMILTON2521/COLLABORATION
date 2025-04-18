<?php

namespace App\Livewire\Equipment;

use App\Models\Customer;
use App\Traits\HttpHelper;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Valve Control Records')]
class ValveControlRecords extends Component
{

    use HttpHelper;
    public $records = [];
    public $customer;


    #[Validate('required|date_format:Y-m-d')]
    public $startDate;

    #[Validate('required|date_format:Y-m-d|after_or_equal:startDate')]
    public $endDate;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->startDate = Carbon::now()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }
    public function queryData()
    {
        $this->validate();

        $startDate = Carbon::createFromFormat('Y-m-d', $this->startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->endDate);

        $this->records = $this->queryValveControlRecords(
            startDate: $startDate,
            endDate: $endDate,
            imei: $this->customer->imei
        );
    }
    public function render()
    {
        return view('livewire.equipment.valve-control-records');
    }
}
