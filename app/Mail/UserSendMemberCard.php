<?php

namespace App\Mail;

use App\Models\Member;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserSendMemberCard extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $member)
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
            subject: '教育評議會(電子會員證)',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $card_img = asset($this->member->card_img); 
        return new Content(
             markdown:'mail.admin_send_card',
             with:[
                'card_img'=>$card_img,
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
