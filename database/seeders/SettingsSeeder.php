<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'API_BASE_URL',
            'value' => env('BACKEND_ENDPOINT'),
            'description' => 'Endpoint for Lorawan backend'
        ]);
        Setting::create([
            'key' => 'API_USER_NAME',
            'value' => 'Tanzania_SKT'
        ]);
        Setting::create([
            'key' => 'API_PASSWORD',
            'value' => '123456'
        ]);
        Setting::create([
            'key' => 'API_TOKEN',
            'value' => '0CC1C9A8BA70820BCAC452D2C6A57498'
        ]);
        Setting::create([
            'key' => 'UNIT_PRICE',
            'type' => 'decimal',
            'value' => 5,
            'description' => 'Unit cost for cubic meter calculation'
        ]);
    }
}
