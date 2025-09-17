<?php

namespace Database\Seeders;

use App\Models\SmsSetting;
use Illuminate\Database\Seeder;

class SmsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsSetting::create([
            'key' => 'SEND_SMS',
            'value' => '0',
            'description' => 'Send SMS',
            'type' => 'boolean'
        ]);
        SmsSetting::create([
            'key' => 'SMS_API_KEY',
            'value' => '56825C766BA254',
            'description' => 'API key for SMS service'
        ]);
        SmsSetting::create([
            'key' => 'SMS_SENDER_ID',
            'value' => 'SKTTZ LTD',
            'description' => 'Sender ID for SMS service'
        ]);
        SmsSetting::create([
            'key' => 'SMS_API_BASE_URL',
            'value' => 'http://smsportal.imartgroup.co.tz/app/',
            'description' => 'Base URL for SMS service'
        ]);
        SmsSetting::create([
            'key' => 'ROUTE_ID',
            'value' => '8',
            'description' => 'SMS GW route id',
            'type' => 'integer'
        ]);
        SmsSetting::create([
            'key' => 'CAMPAIGN_ID',
            'value' => '1752',
            'description' => 'SMS GW campaign id',
            'type' => 'integer'
        ]);
    }
}
