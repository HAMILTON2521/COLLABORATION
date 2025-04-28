<?php

namespace App\Traits;

use App\Models\Setting;

trait SettingsHelper
{
    public function getSettingValue($key)
    {
        return Setting::where('key', $key)->first()->value;
    }
}
