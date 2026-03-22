<?php

namespace App\Admin\Forms;

use App\Jobs\MemberCard;
use App\Mail\MemberCard as MemberCardMail;
use App\Models\Member;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Mail;

class MemberEditTypeForm extends Form implements LazyRenderable
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
        $saveAction = $input['_save_action_type'] ?? '1';

        if (empty($id)) {
            return $this->response()->error('發生異常！');
        }

        $member = Member::find($id);
        if (!$member) {
            return $this->response()->error('會員不存在！');
        }

        // 更新所有字段
        $member->chiname = $input['chiname'] ?? $member->chiname;
        $member->engname = $input['engname'] ?? $member->engname;
        $member->phone = $input['phone'] ?? $member->phone;
        $member->email = $input['email'] ?? $member->email;
        $member->company = $input['company'] ?? $member->company;
        $member->job_type = $input['job_type'] ?? $member->job_type;
        $member->job_name = $input['job_name'] ?? $member->job_name;
        $member->company_type = $input['company_type'] ?? $member->company_type;
        $member->member_type = $input['member_type'];
        $member->recommender = $input['recommender'] ?? $member->recommender;


        if ($input['member_type'] == 3) {
            $member->member_expired_at = '2099-12-31';
        } else {
            $member->member_expired_at = $input['member_expired_at'] ?? $member->member_expired_at;
        }

        $member->save();

        // 保存并更新会员证 + 发送邮件
        if ($saveAction == '2') {
            MemberCard::dispatchSync($member);
            $member->refresh();

            if (!empty($member->email)) {
                Mail::to($member->email)->send(new MemberCardMail($member));
            }

            return $this->response()
                ->success('保存成功，會員證已更新並發送郵件！')
                ->refresh();
        }

        return $this->response()
            ->success('保存成功！')
            ->refresh();
    }

    /**
     * Build the form.
     */
    public function form()
    {
        $this->row(function ($row) {
            $row->width(6)->text('chiname')->rules('required');
            $row->width(6)->text('engname')->rules('required');
        });

        $this->row(function ($row) {
            $row->width(6)->text('phone');
            $row->width(6)->email('email');
        });

        $this->row(function ($row) {
            $row->width(6)->text('company');
            $row->width(6)->select('company_type')->options(admin_trans('member.options.company_type'));
        });

        $this->row(function ($row) {
            $row->width(6)->select('job_type')->options(admin_trans('member.options.job_type'));
            $row->width(6)->text('job_name');
        });

        $this->row(function ($row) {
            $row->width(6)->select('member_type', '會員類型')
                ->options(admin_trans('member.options.member_type'))
                ->rules('required')
                ->help('變更會員類型請同步修改「到期時間」');
            $row->width(6)->date('member_expired_at', '到期時間');
        });

        $this->row(function ($row) {
            $row->width(6)->text('recommender');
            $row->width(6)->display('created_at');
        });

 

        $this->hidden('_save_action_type')->default('1');
    }

    /**
     * 覆盖 footer：自定义 3 个按钮 + 内联 JS
     */
    protected function renderFooter()
    {
        $formId = $this->getElementId();

        return <<<HTML
<div class="box-footer row d-flex">
    <div class="col-md-12" style="text-align: center;">
        <button type="submit" style="display:none;"></button>
        <button type="button" class="btn btn-default btn-member-cancel" style="margin: 0 5px;">
            <i class="feather icon-x"></i> 取消
        </button>
        <button type="button" class="btn btn-warning btn-member-save-send" style="margin: 0 5px;">
            <i class="feather icon-send"></i> 更新並發送郵件
        </button>
        <button type="button" class="btn btn-primary btn-member-save-only" style="margin: 0 5px;">
            <i class="feather icon-save"></i> 僅保存
        </button>
    </div>
</div>
<script>
(function(){
    var t = setInterval(function(){
        var theForm = $('#{$formId}');
        if (!theForm.length) return;
        clearInterval(t);

        // 监听会员类型变化，弹窗提醒
        theForm.find('select[name="member_type"]').on('change', function(){
            var val = $(this).val();
            if (val == 3) {
                theForm.find('input[name="member_expired_at"]').val('2099-12-31').prop('readonly', true);
            } else {
                theForm.find('input[name="member_expired_at"]').prop('readonly', false);
            }
            Swal.fire({
                type: 'info',
                title: '提示',
                text: '檢測到會員類型變更，請同步修改「到期時間」。',
                confirmButtonText: '確認'
            });
        });

        // 取消
        theForm.find('.btn-member-cancel').on('click', function(){
            var modal = theForm.closest('.modal');
            if (modal.length) {
                modal.modal('hide');
            }
        });

        // 仅保存
        theForm.find('.btn-member-save-only').on('click', function(){
            theForm.find('input[name="_save_action_type"]').val('1');
            theForm.find('[type="submit"]').click();
        });

        // 保存并更新会员证 + 发送邮件
        theForm.find('.btn-member-save-send').on('click', function(){
            theForm.find('input[name="_save_action_type"]').val('2');
            theForm.find('[type="submit"]').click();
        });
    }, 100);
})();
</script>
HTML;
    }

    /**
     * Default data.
     *
     * @return array
     */
    public function default()
    {
        $id = $this->payload['id'] ?? null;
        $member = Member::find($id);

        return $member ? $member->toArray() : [];
    }
}
