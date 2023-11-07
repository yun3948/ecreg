<?php

namespace App\Listeners;

use App\Events\MemberCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberCheck as MemberCheckMail;

use Illuminate\Support\Facades\Bus;
use App\Jobs\MemberCard;
use App\Jobs\SendMemberCheckEmail;
class SendMemberCheckNotification 
{
    public $queue = 'listeners';
    public $delay = 60;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

//    public function shouldQueue( $event)
//    {
//        return !empty($event->member->card_img) && !empty($event->member->email);
//    }



    /**
     * Handle the event.
     *
     * @param  \App\Events\MemberCheck  $event
     * @return void
     */
    public function handle(MemberCheck $event)
    {
        $member = $event->member;

        if(empty($member->email)) {
            return false;
        }

        Bus::chain([
            new MemberCard($member),
            new SendMemberCheckEmail($member),
        ])->dispatch();


        // 发送通知邮件

        //不同会员发送不同邮件通知


//        Mail::to($member->email)->send(new MemberCheckMail($member));

    }
}
