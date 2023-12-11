<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Bus;

use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberRegister as MemberRegisterMail;

class SendMemberRegisterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

 
    protected $member;

    /**
     * Create a new job instance.
     *
     *  
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }


    public function handle()
    { 
        $member = $this->member;
        Mail::to($member->email)->send(
            new MemberRegisterMail($this->member)
        );

    }
}
