<?php

namespace App\Listeners;

use App\Events\MemberCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberCard as MemberCardMail;
class SendMemberNotification implements ShouldQueue
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

    public function shouldQueue( $event)
    {
        return !empty($event->member->card_img) && !empty($event->member->email);
    }



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

        // 发送通知邮件
        Mail::to($member->email)->send(new MemberCardMail($member));

    }
}
