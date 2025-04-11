<?php

namespace App\Livewire\Files;

use App\Models\Setting;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Get Archive List')]
class Files extends Component
{
    use HttpHelper;

    public function getFiles()
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;
        $areaId = Setting::where('key', 'BACKEND_AREA_ID')->first()->value;
        $sysconfigEquipmentId = Setting::where('key', 'SYSTEM_CONFIG_EQUIPMENT_ID')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'getAreaArchives',
            'apiToken' => $api_token,
            'params'   => [
                'energyType' => 'GAS',
                'pageNumber' => '10',
                'pageSize' => '10',
                'areaId'      => $areaId,
                'searchContent' => '',
                'sysconfigEquipmentId' => $sysconfigEquipmentId
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);

        return $response['values'] ?? [];
    }
    public function render()
    {
        return view('livewire.files.files', [
            'files' => $this->getFiles()
        ]);
    }
}
