<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;
use Illuminate\Support\Facades\URL;

class MemberRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // 普通 附属
        if(in_array($this->member->member_type,[1,4])) {
            return $this->normal();
        }
        // 资深 永久
        if(in_array($this->member->member_type,[2,3])) {
            return $this->zishen();
        }

    }

    public function normal(){
        $url = URL::temporarySignedRoute(
            'email_confirm', now()->addMinutes(60), ['user_id' => $this->member->id]
        );
        return $this->subject('請驗證電郵地址並確認註冊')
            ->markdown('mail.member_email_confirm',['url'=>$url]);

    }

    public function zishen(){
        return $this->subject('歡迎申請加入教育評議會')
            ->markdown('mail.member_register_for_check');

    }
}
