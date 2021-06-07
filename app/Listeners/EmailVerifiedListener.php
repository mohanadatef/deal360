<?php

namespace App\Listeners;

use App\Mail\EmailVerifiedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        $details = [
        'title' => 'Mail for verify',
        'body' =>  'dddd',
    ];
        Mail::to($event->data->email)->send(new EmailVerifiedMail($details));
    }
}
