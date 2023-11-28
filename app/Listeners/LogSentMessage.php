<?php

namespace App\Listeners;

use App\Models\MailLog;
use App\Models\Member;
use App\Models\MemberLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;

use Symfony\Component\Mime\Email;
//邮件发送之后
class LogSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Mail\Events\MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
 

        //
        $message = $event->message;

        $email = $this->formatAddressField($message,'To');

        $subject = $message->getSubject();
        $content = $message->getBody();

       

        // 根据最后一条记录来确定会员
        $member = Member::where('email',$email)
        // ->where('status','>',0)
        ->latest()->first();

         if(!$member) {
            return true;
         }

        $data = []; 
        $data = [
            'member_id'=>$member->id,
            'email'=>$email,
            'type'=>'mail',
            'message'=>'發送郵件：'.$subject,            
        ];
        MemberLog::create($data);

        //記錄到郵件發送日志
        MailLog::create([
            'mail'=>$email,
            'subject'=>$subject,
            'content'=>''
            // 'content'=>$content
        ]);


    }


    function formatAddressField(Email $message, string $field): ?string
	{
		$headers = $message->getHeaders();

		return $headers->get($field)?->getBodyAsString();
	}
}
