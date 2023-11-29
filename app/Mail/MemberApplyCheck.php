<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;
class MemberApplyCheck extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $member;
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
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '會員審批',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $member_level = MEMBER_TYPE_ARR[$this->member->member_type];
        $card_img = asset($this->member->card_img);
        return new Content(
            markdown:'mail.admin_pass_member_apply',
            with:[
                'username'=>$this->member->chiname,
                'card_img'=>$card_img,
                'member_level'=>$member_level
             ]
               
           
       );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
