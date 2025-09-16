<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\MessageTemplate;
use App\Models\Setting;
use App\Models\SmsSetting;
use App\Traits\SmsHelper;

class CustomerObserver
{
    use SmsHelper;
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $send_sms = (int) SmsSetting::get('SEND_SMS');
        if ($send_sms) {
            $data = [
                'firstName' => $customer->first_name,
                'lastName' => $customer->last_name,
                'fullName' => $customer->full_name,
                'deviceImei' => $customer->imei,
                'account' => $customer->ref,
                'street' => $customer->street,
                'region' => $customer->region->name,
                'district' => $customer->district->name,
                'activity' => 'Customer_Creation',
                'phone' => $customer->phone,
            ];

            $message = $this->getTemplate(data: $data);
            if ($message) {
                $phone = '255' . substr($customer->phone, 1, 9);
                $this->sendNormalSms(msg: $message, phone: $phone);
            }
        }

    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        //
    }
}
