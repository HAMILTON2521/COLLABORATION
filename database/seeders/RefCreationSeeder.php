<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefCreationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'SELCOM_TILL_NUMBER',
            'value' => '61135303'
        ]);
        Setting::create([
            'key' => 'FIRST_ACCOUNT_NUMBER',
            'value' => 300300,
            'type' => 'integer'
        ]);
    }
}
