<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member as MemberModel;
use App\Models\MemberLog;
use Carbon\Carbon;
use App\Logic\MemberLogic;

class MemberExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->member_zishen_expire();
        return Command::SUCCESS;
    }


     // 获取 30天内即将过期的 资深会员 写入记录表  不写入上面的原因是 可以更多的记录即将过期会员
     public function member_zishen_expire()
     {
 
         $day = Carbon::now()->addDays(30);
         MemberModel::query()
             ->where('member_expired_at', '<=', $day)
             ->where('member_type', 2) // 类型
             ->where('status', 1) // 状态
             // ->where('member_fee_status', 0) // 發送后修改狀態 防止重複發送
             ->chunkById(100, function ($lists) {
                 foreach ($lists as $member) {
                     (new MemberLogic())->member_expire($member->id);
                 }
             });
     }
}
