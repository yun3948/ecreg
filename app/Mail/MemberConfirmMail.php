<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;
use Illuminate\Support\Facades\URL;

class MemberConfirmMail extends Mailable
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
        $card_img = asset($this->member->card_img);

        // 普通 附属
        if(in_array($this->member->member_type,[1,4])) {
            return $this->subject('歡迎加入教育評議會(含電子會員證)')
                ->markdown('mail.member_register_succ',
                [
                    'card_img'=>$card_img,
                    'username' => $this->member->chiname,
                ]);
        }


    }
}
