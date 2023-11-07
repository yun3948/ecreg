<?php

namespace App\Admin\Forms;

use App\Models\Member;
use App\Models\MemberLog;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Contracts\LazyRenderable;

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
        $message = '管理員修改，設置會員過期時間為：' . $input['member_expired_at'];

        $remark = '';
        if (!empty($input['remark'])) {
            $remark = $input['remark'];
        }
        MemberLog::level_log($id, $message, $remark);


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
        $this->datetime('member_expired_at', '過期時間');
        $this->textarea('remark', '備注');
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
        $data = Member::find($id)->toArray();

        return $data;
    }
}
