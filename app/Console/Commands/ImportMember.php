<?php

namespace App\Console\Commands;

use App\Models\Member;
use Illuminate\Console\Command;
use App\Events\MemberRegister;
use Illuminate\Support\Facades\Mail;

use App\Jobs\MemberCard;
use App\Mail\MemberConfirmMail;

use Illuminate\Support\Facades\Bus;

use App\Jobs\SendMemberRegisterEmail;

class ImportMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import member form csv';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $file = '/mnt/d/member.csv';
        $fp = fopen($file, 'rb');
        $i = 0;
        while (($tmp = fgetcsv($fp)) !== false) {
            if ($i == 0) {
                $i++;
                continue;
            }
            //字段处理
            $data = [];
            $data['chiname'] = $tmp[0] ?: '';
            $data['phone'] = $tmp[1] ?: '';
            $data['email'] = $tmp[2] ?: '';
            $data['member_type'] = $tmp[3] ?: 0;
            $data['job_type'] = $tmp[4] ?: 0;
            $data['company'] = $tmp[5] ?: '';
            $data['job_name'] = $tmp[6] ?: '';
            $data['company_type'] = $tmp[7] ?: 0;
            $data['created_at'] = date('Y-m-d H:i:s', strtotime($tmp[8]));
            $data['member_expired_at'] =  date('Y-m-d', strtotime($tmp[10]));
            $data['status'] = 1;

            $member =   Member::create($data);

           
            Bus::chain([
                new MemberCard($member),
                function () use($member){ 
                    //发送邮件
                    Mail::to($member->email)->send(new MemberConfirmMail($member));
                
                }
            ])->dispatch();
 

        }

        fclose($fp);

        return Command::SUCCESS;
    }
}
