<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;
use Storage;
class MemberCheck extends Mailable
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
        $this->member->card_img = asset($this->member->card_img);

        return $this->subject('歡迎加入教育評議會(含電子會員證)')
            ->markdown('mail.member_check_succ',['card_img'=>($this->member->card_img)]);

    }
}
