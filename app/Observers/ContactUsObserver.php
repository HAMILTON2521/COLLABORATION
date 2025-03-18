<?php

namespace App\Observers;

use App\Mail\ContactUsCreated;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactUsObserver
{
    /**
     * Handle the ContactUs "created" event.
     */
    public function created(ContactUs $contactUs): void
    {
        if ($contactUs->email) {
            Mail::to($contactUs)->send(new ContactUsCreated($contactUs));
        }
    }

    /**
     * Handle the ContactUs "updated" event.
     */
    public function updated(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "deleted" event.
     */
    public function deleted(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "restored" event.
     */
    public function restored(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "force deleted" event.
     */
    public function forceDeleted(ContactUs $contactUs): void
    {
        //
    }
}
