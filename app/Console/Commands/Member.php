<?php

namespace App\Console\Commands;

use App\Jobs\MemberAutoRenewal as JobsMemberAutoRenewal;
use App\Jobs\MemberCard;
use App\Logic\MemberLogic;
use App\Mail\MemberAutoRenewal;
use App\Mail\MemberExpiredNotice;
use App\Models\Member as MemberModel;
use App\Models\MemberLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;

class member extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:last';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '会员续费';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        // 查询距离过期30天的 会员
        $this->member_expire();
        $this->member_normal();
        $this->member_zishen();
        $this->member_zishen_expire();
        return Command::SUCCESS;
    }

    //批量处理会员过期时间
    public function member_expire()
    {

        MemberModel::whereNull('member_expired_at')
            ->chunkById(100, function ($lists) {

            foreach ($lists as $item) {

                // dd($item->created_at->modify('+1 year'));
                //默认一年
                $item->member_expired_at =  $item->created_at->addDays(365);
                $item->save();
            }
        });
    }

    // 普通会员 到期续费 重新发卡  自动续期
    public function member_normal()
    {
        // 资深会员到期如果不续费 则会降级为普通会员 发送普通会员卡
        // 所有会员都需要发送续费邮件
        $today = Carbon::now();
        MemberModel::where('member_expired_at', '<', $today)
            ->where('status', 1)
             ->where('member_type', '!=', 3)  // 非永久会员 防止永久会员接收邮件
            ->chunkById(100, function ($lists) {

                foreach ($lists as $member) {

                    //资深  自动降级为普通  到期修改状态  需要 后台 提交
                    if ($member->member_type == 2) {

                        //降级 更新

                        $member->member_type = 1;
                        $member->member_fee_status = 0;

                        // 记录日志 降级
                        MemberLog::create([
                            'member_id' => $member->id,
                            'email' => $member->email,
                            'type' => 'level',
                            'message' => '會員過期自動降級'
                        ]);
                    }

                    //更新会员有效期日期到明年
                    $member->member_expired_at = $member->member_expired_at->addDays(365);
                    $member->save();

                    if ($member->member_type == 3) {
                        // 永久会员重新生成会员卡  ，防止信息不更新
                        Bus::chain([
                            //生成图片
                            new MemberCard($member),

                        ])->dispatch();
                    } else {
                        Bus::chain([
                            //生成图片
                            new MemberCard($member),
                            //发送邮件
                            new JobsMemberAutoRenewal($member)
                        ])->dispatch();
                    }
                }
            });
    }

    // 资深会员 发送续费提醒 提前一個月
    // 如果满足条件 发送可续费永久的的邮件， 否则发送普通的续费邮件
    public function member_zishen()
    {
        //
        $day = Carbon::now()->addDays(30);
        MemberModel::query()
            ->where('member_expired_at', '<=', $day)
            ->where('member_type', 2)// 类型
            ->where('member_fee_status', 0) // 發送后修改狀態 防止重複發送
            ->where('status', 1)// 状态

            ->chunkById(100, function ($lists) {

                foreach ($lists as $member) {
                    //需要判断 有资格申请永久的会员 发送邮件不一致
                    // 发送过期提醒通知邮件
                    Mail::to($member)->send(new MemberExpiredNotice($member));

                    //修改状态
                    $member->member_fee_status = 1;
                    $member->save();
                }
            });
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
