<?php

namespace Database\Seeders;

use App\Models\MessageTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageTemplate::create([
            'title' => 'Payment_Success',
            'body' => 'Dear {firstName}, your payment of Tsh {amount} has been received successfully. Thank you.',
            'description' => 'Template for successful payment notifications',
            'ti_icon' => 'ti-report-money',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {amount}, {account}, {volume}'
        ]);
        MessageTemplate::create([
            'title' => 'Payment_Failure',
            'body' => 'Dear {firstName}, your payment of {amount} has failed. Please try again.',
            'description' => 'Template for failed payment notifications',
            'ti_icon' => 'ti-report-money',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {amount}, {account}'
        ]);
        MessageTemplate::create([
            'title' => 'Account_Activation',
            'body' => 'Dear {firstName}, your account has been activated successfully. Welcome aboard!',
            'description' => 'Template for account activation notifications',
            'placeholders' => '{firstName}, {lastName}, {fullName}'
        ]);
        MessageTemplate::create([
            'title' => 'Welcome_Customer',
            'body' => 'Dear {fullName}, welcome to our service! We are glad to have you.',
            'description' => 'Template for welcoming new customers',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {deviceImei}, {account}, {street}, {district}, {region}',
            'ti_icon' => 'ti-user'
        ]);
        MessageTemplate::create([
            'title' => 'Device_Credited',
            'body' => 'Dear {firstName}, your device has been credited with {amount}. Thank you for using our service.',
            'description' => 'Template for device credit notifications',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}, {volume}',
            'ti_icon' => 'ti-circle-plus'
        ]);
        MessageTemplate::create([
            'title' => 'Device_Debited',
            'body' => 'Dear {firstName}, your device has been debited with {amount}. Please check your balance.',
            'description' => 'Template for device debit notifications',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}, {volume}',
            'ti_icon' => 'ti-message-minus'
        ]);
        MessageTemplate::create([
            'title' => 'Valve_Opened',
            'body' => 'Dear {firstName}, the valve for your device has been opened. Thank you for using our service.',
            'description' => 'Template for valve opening notifications',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}',
            'ti_icon' => 'ti-lock-open'
        ]);
        MessageTemplate::create([
            'title' => 'Valve_Closed',
            'body' => 'Dear {firstName}, the valve for your device has been closed. Please contact support for assistance.',
            'description' => 'Template for valve closure notifications',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}',
            'ti_icon' => 'ti-lock-off'
        ]);
        MessageTemplate::create([
            'title' => 'Low_Balance_Alert',
            'body' => 'Dear {firstName}, your balance is low. Please recharge to continue enjoying our service.',
            'description' => 'Template for low balance alerts',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}, {volume}, {balance}',
            'ti_icon' => 'ti-alert-circle'
        ]);
        MessageTemplate::create([
            'title' => 'High_Consumption_Alert',
            'body' => 'Dear {firstName}, your consumption has been unusually high. Please check your device for any issues.',
            'description' => 'Template for high consumption alerts',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}',
            'ti_icon' => 'ti-alert-circle'
        ]);
        MessageTemplate::create([
            'title' => 'Payment_Reminder',
            'body' => 'Dear {firstName}, this is a reminder that your payment of {amount} is due soon. Please make the payment to avoid service interruption.',
            'description' => 'Template for payment reminders',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}, {amount}',
            'ti_icon' => 'ti-bell-bolt'
        ]);
        MessageTemplate::create([
            'title' => 'Service_Disruption_Alert',
            'body' => 'Dear {firstName}, we are experiencing a service disruption. Our team is working to resolve the issue as soon as possible.',
            'description' => 'Template for service disruption alerts',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}'
        ]);
        MessageTemplate::create([
            'title' => 'Service_Resumed_Notification',
            'body' => 'Dear {firstName}, the service has been resumed. Thank you for your patience.',
            'description' => 'Template for service resumption notifications',
            'placeholders' => '{firstName}, {lastName}, {fullName}, {account}, {deviceImei}'
        ]);
    }
}
