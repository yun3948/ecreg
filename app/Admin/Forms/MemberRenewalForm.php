<?php

namespace App\Admin\Forms;

use App\Models\Member;
use App\Models\MemberLog;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Contracts\LazyRenderable;
use App\Jobs\MemberCard;
use App\Jobs\SendMemberRenewalCheckEmail;
use App\Logic\MemberLogic;
use App\Mail\MemberRenewalCheck;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;

class MemberRenewalForm extends Form  implements LazyRenderable
{
    use LazyWidget;
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        $id = $this->payload['id'] ?? null;

 

        //更新  字段 
        $member = Member::find($id);
        $member->member_expired_at = $input['member_expired_at'];
        $member->save();

        //記錄日志
        $message = '管理員修改續費，設置會員過期時間為：' . $input['member_expired_at'];

        $remark = '';
        if (!empty($input['remark'])) {
            $remark = $input['remark'];
        }
        MemberLog::level_log($id, $message, $remark);

        // 会员续费生效，移除 记录
        (new MemberLogic())->member_efect($id);

        // 发送 成功续费提醒
        $chain = [
            new MemberCard($member)            
        ];

        if(!empty($input['send_mail'])) {
            array_push($chain,new SendMemberRenewalCheckEmail($member));
        }

        Bus::chain($chain)->dispatch();;

        return $this
            ->response()
            ->success('處理完成！')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->confirm('確認提交？', '');

        $this->display('chiname');
        $this->display('engname');
        $this->display('phone');
        $this->display('email');
        //过期时间 从当前的过期时间往后 365 
        $this->datetime('member_expired_at', '過期時間');
        $this->textarea('remark', '備注');
        $this->checkbox('send_mail','通知')->options([
            '1'=>'發電郵通知續會成功'
        ]);
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        // 设置数据
        $id = $this->payload['id'] ?? null;
        $member = Member::find($id);

        // 设置默认过期时间为 365 天以后
        $member->member_expired_at = $member->member_expired_at->addDays(365);

        $data = $member->toArray();

        $data['send_mail'] = '1';
        return $data;
    }
}
