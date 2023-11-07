<?php

namespace App\Providers;


use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\MemberRegister;
use App\Events\MemberCheck;

use App\Listeners\SendMemberNotification;
use App\Listeners\SendMemberRegisterNotification;
use App\Listeners\SendMemberCheckNotification;
use App\Listeners\CreateMemberCard;


use App\Listeners\LogSendingMessage;
use App\Listeners\LogSentMessage;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        MessageSending::class => [
            LogSendingMessage::class,
        ],
     
        MessageSent::class => [
            LogSentMessage::class,
        ],
 

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        //注册
        MemberRegister::class=>[
            SendMemberRegisterNotification::class
        ],

        //审核
        MemberCheck::class=>[
            SendMemberCheckNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
//         Event::listen(queueable(function ($event){
//
//         }));
    }
}
