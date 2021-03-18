<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\WhoDidLogin;
use App\Listeners\WhoDidLogout;
use App\Listeners\CRUD;
use App\Events\Login;
use App\Events\Logout;
use App\Events\InteractionWithNews;

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

        Login::class => [
            WhoDidLogin::class,
        ],

        Logout::class => [
            WhoDidLogout::class,
        ],

        InteractionWithNews::class => [
            CRUD::class,
        ]
        
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
