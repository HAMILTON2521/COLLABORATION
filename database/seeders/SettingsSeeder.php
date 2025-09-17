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
            'value' => 'http://en.energy.zhongyismart.com/api/commonInternal.jsp',
            'description' => 'Endpoint for Lorawan backend'
        ]);
        Setting::create([
            'key' => 'SEND_TO_LORAWAN',
            'value' => '0',
            'description' => 'Send requests to Lorawan backend',
            'type' => 'boolean'
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
            'key' => 'BACKEND_AREA_ID',
            'type' => 'integer',
            'value' => 855
        ]);
        Setting::create([
            'key' => 'SYSTEM_CONFIG_EQUIPMENT_ID',
            'type' => 'string',
            'value' => 178
        ]);
        Setting::create([
            'key' => 'UNIT_PRICE',
            'type' => 'decimal',
            'value' => 7341.77,
            'description' => 'Unit cost for cubic meter calculation'
        ]);
        Setting::create([
            'key' => 'JWT_SECRET',
            'value' => 'gVC7MlHwCvKH0SGkhYZbzuNK7RwbhTJokcFhXj3mLTMu2lIZx2Lio3I3dCFkVD2K'
        ]);
        Setting::create([
            'key' => 'JWT_EXPIRY_SECONDS',
            'type' => 'integer',
            'value' => 86400
        ]);
        Setting::create([
            'key' => 'AIRTEL_UAT_CLIENT_ID',
            'type' => 'string',
            'value' => '351c3a8f-1904-41d8-86d3-9eda1f4c4cd5'
        ]);
        Setting::create([
            'key' => 'AIRTEL_UAT_CLIENT_SECRET_KEY',
            'type' => 'string',
            'value' => '4b60ac43-8990-49cb-b7ac-b094128f174a'
        ]);
        Setting::create([
            'key' => 'AIRTEL_PROD_CLIENT_ID',
            'type' => 'string',
            'value' => 'fc350837-0bf5-4284-b1ab-7156c934c15f'
        ]);
        Setting::create([
            'key' => 'AIRTEL_PROD_CLIENT_SECRET_KEY',
            'type' => 'string',
            'value' => 'f7469040-e3e5-4259-9392-d0df434d64a5'
        ]);
        Setting::create([
            'key' => 'AIRTEL_C2B_UAT_CALLBACK_URL',
            'type' => 'string',
            'value' => 'https://demo.skttanzania.co.tz/api/callback/uat/airtel'
        ]);
        Setting::create([
            'key' => 'AIRTEL_C2B_PROD_CALLBACK_URL',
            'type' => 'string',
            'value' => 'https://demo.skttanzania.co.tz/api/callback/uat/airtel'
        ]);
        Setting::create([
            'key' => 'AIRTEL_C2B_UAT_HASH_KEY',
            'type' => 'string',
            'value' => 'c01f2a724e05458d906f115a065bd2fb'
        ]);
        Setting::create([
            'key' => 'AIRTEL_C2B_PROD_USSD_PUSH_URL',
            'type' => 'string',
            'value' => 'https://openapi.airtel.africa/'
        ]);
        Setting::create([
            'key' => 'AIRTEL_C2B_UAT_USSD_PUSH_URL',
            'type' => 'string',
            'value' => 'https://openapiuat.airtel.africa/'
        ]);
        Setting::create([
            'key' => 'AIRTEL_C2B_PROD_HASH_KEY',
            'type' => 'string',
            'value' => 'c01f2a724e05458d906f115a065bd2fb'
        ]);
        Setting::create([
            'key' => 'AIRTEL_MERCHANT_CODE',
            'type' => 'string',
            'value' => 'RYNQXFN1'
        ]);
        Setting::create([
            'key' => 'JWT_AIRTEL_SECRET',
            'value' => 'KbPeShVmYq3t6w9z$C&F)J@NcQfTjWnZr4u7x!A%D*G-KaPdSgVkXp2s5v8y/B?E'
        ]);
        Setting::create([
            'key' => 'JWT_AIRTEL_SUB',
            'value' => 'airtel_africa'
        ]);
        Setting::create([
            'key' => 'JWT_AIRTEL_EXPIRY_SECONDS',
            'type' => 'integer',
            'value' => 86400
        ]);
        Setting::create([
            'key' => 'MINIMUM_PAYMENT_AMOUNT',
            'type' => 'decimal',
            'value' => 1000
        ]);
        Setting::create([
            'key' => 'SELCOM_VENDOR_ID',
            'value' => 'TILL61135303'
        ]);
        Setting::create([
            'key' => 'SELCOM_API_KEY',
            'value' => 'TILL61135303-10a7019541044a58b63e66b1e5f922e0'
        ]);
        Setting::create([
            'key' => 'SELCOM_API_SECRET',
            'value' => 'a8e3a8-8ddc29-44e4a8-98c27f-fe4f0a-81'
        ]);
        Setting::create([
            'key' => 'SELCOM_BASE_URL',
            'value' => 'https://apigw.selcommobile.com/v1'
        ]);
        Setting::create([
            'key' => 'SELCOM_CALLBACK_URL',
            'value' => route('selcom.callback')
        ]);
        Setting::create([
            'key' => 'SELCOM_MERCHANT_CALLBACK_URL',
            'value' => route('selcom.merchant.callback')
        ]);
        Setting::create([
            'key' => 'SELCOM_MERCHANT_TOKEN',
            'value' => 'eyJpc3MiOiJTS1QgVGFuemFuaWEiLCJpYXQiOjE3NDkwNTUyNj'
        ]);

    }
}
