<?php

namespace App\Listeners\Admin\Acl;


use App\Mail\Admin\Acl\EmailVerifiedMail;
use Illuminate\Support\Facades\Mail;

class EmailVerifiedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //call mail to send email
        //$event->data->email => email user will send to him email
        //$event->details => bodey of email
        Mail::to($event->data->email)->send(new EmailVerifiedMail($event->details));
    }
}
