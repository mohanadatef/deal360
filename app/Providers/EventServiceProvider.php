<?php

namespace App\Providers;

use App\Events\Admin\Acl\EmailVerifiedEvent;
use App\Events\Api\Acl\EmailForgotPasswordEvent;
use App\Events\Api\Setting\RatingEvent;
use App\Listeners\Api\Acl\EmailForgotPasswordListener;
use App\Listeners\Admin\Acl\EmailVerifiedListener;
use App\Listeners\Api\Setting\RatingListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        //event send email when approve user
        EmailVerifiedEvent::class => [
            EmailVerifiedListener::class,
        ],
        EmailForgotPasswordEvent::class => [
            EmailForgotPasswordListener::class,
        ],
        RatingEvent::class => [
            RatingListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
