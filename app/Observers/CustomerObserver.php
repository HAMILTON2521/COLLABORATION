<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\MessageTemplate;
use App\Traits\SmsHelper;

class CustomerObserver
{
    use SmsHelper;
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $data = $this->sendMessageEnabledFor('Customer_Creation');
        if ($data['canSendSms']) {
            if ($data['hasTemplate']) {
                if ($customer->phone) {
                    $template = MessageTemplate::find($data['templateId']);
                    if ($template) {
                        $message = $this->parseTemplate($template->body, [
                            'firstName' => $customer->first_name,
                            'lastName' => $customer->last_name,
                            'fullName' => $customer->full_name,
                            'deviceImei' => $customer->imei,
                            'account' => $customer->account,
                        ]);
                        info($message);
                    }
                }
            } else {
                info('SMS not sent, template missing');
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
