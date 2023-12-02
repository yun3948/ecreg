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

class MemberApplyCheckRefuse extends Mailable  implements ShouldQueue
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
        return new Content(
            markdown: 'mail.admin_refuse_member_apply',
            with: [
                'username' => $this->member->chiname,
                'member' => $this->member,
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
