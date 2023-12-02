<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;
use App\Models\MemberChangeLevel;

class MemberApplyCheck extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $member;
    protected $log;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
        // 获取最新的log 记录
        $this->log = MemberChangeLevel::query()
            ->where('user_id', $this->member->id)
            ->latest()
            ->first();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = '會員審批';
        if ($this->log->member_level == 2) {
            $subject = '教評資深會員申請結果';
        }

        if ($this->log->member_level == 3) {
            $subject = '教評永久會員申請結果';
        }

        return new Envelope(
            subject: $subject,
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
            markdown: 'mail.admin_pass_member_apply',
            with: [
                // 'member' => $this->member,
                'username' => $this->member->chiname,
                'card_img' => $card_img,
                'member_level' => $member_level
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
