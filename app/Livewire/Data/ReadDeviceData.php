<?php

namespace App\Livewire\Data;

use App\Traits\HttpHelper;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Device Data')]
class ReadDeviceData extends Component
{
    use HttpHelper;

    public array $deviceData = [];


    #[Validate('required|date_format:Y-m-d')]
    public $startDate;

    #[Validate('required|date_format:Y-m-d|after_or_equal:startDate')]
    public $endDate;

    public function mount(): void
    {
        $this->startDate = Carbon::now()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }


    public function queryDeviceData(): void
    {
        $this->validate();

        $startDate = Carbon::createFromFormat('Y-m-d', $this->startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->endDate);

        try {
            $this->deviceData = $this->readDeviceData(
                startDate: $startDate,
                endDate: $endDate
            );
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.data.read-device-data');
    }
}
