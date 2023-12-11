<?php

namespace App\Admin\Forms;

use App\Events\MemberCheck;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use App\Models\Member;

class MemeberCheck extends Form implements LazyRenderable
{
    use LazyWidget;

    // 使用异步加载功能

    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        // 处理数据
        $id = $this->payload['id'];

        if (empty($id)) {
            return $this->response()->error('發生異常！');
        }

        $user = Member::find($id);
        $user->status = $input['status'];
        $user->save();

        
        if($input['status'] == 1) {
          
        }else{
            // 发送失败邮件
        }
        // 触发事件  发送邮件通知
        event(new MemberCheck($user));
        


        return $this
            ->response()
            ->success('操作成功！')
            ->refresh();
    }


    /**
     * Build a form here.
     */
    public function form()
    {
        // 显示表单
        $this->row(function ($row) {
            $row->width(6)->display('chiname')->disable();

            $row->width(6)->display('engname')->disable();

            $row->width(6)->display('phone')->disable();
            $row->width(6)->display('email')->disable();

            $row->width(6)->select('member_type')->options(admin_trans('member.options.member_type'));

            $row->width(6)->select('job_type')->options(admin_trans('member.options.job_type'))->disable();

            $row->width(6)->display('company')->disable();

            $row->width(6)->display('job_name')->disable();

            $row->width(6)->select('company_type')->options(admin_trans('member.options.company_type'))->disable();

            $row->width(6)->display('recommender')->disable();

            $row->width(6)->display('created_at')->disable();

        });


        $this->row(function ($row) {
            $row->width(12)->radio('status', '狀態')->options(admin_trans('member.options.status_check'))->rules('required');
        });
        
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
