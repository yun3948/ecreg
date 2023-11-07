<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use App\Models\Member;
use App\Models\MemberChangeLevel;
use App\Models\MemberLog;

class MemberLevelCheckForm extends Form  implements LazyRenderable
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
        // 处理数据
        $id = $this->payload['id'];
        if (empty($id)) {
            return $this->response()->error('發生異常！');
        }
        $log = MemberChangeLevel::find($id);
        //根據狀態判斷

        //通過審核 修改會員等級
        if($input['status'] == 1) {

            $member = Member::find($log->user_id);
            $member->member_type = 3;
            $member->save();

           $message = '管理通過永久會員申請';
           $remark = '管理通過永久會員申請';
            if(!empty($input['remark'])) {
                $remark  = $input['remark'];
            }
            
            MemberLog::level_log($member->id,$message,$remark);
        } 

        // 更新申請記錄
        $log->status = $input['status'];
        $log->save();

        
 
        return $this
            ->response()
            ->success('審核完成！')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        // 展示信息  // 審核可以輸入備注

        $this->row(function($row){
            $row->width(6)->display('member.chiname')->disable();
            $row->width(6)->display('member.engname')->disable();

            $row->width(6)->display('member.phone')->disable();
            $row->width(6)->display('member.email')->disable(); 

        });

        $this->row(function ($row) {
            $row->width(12)->radio('status', '狀態')->options(admin_trans('member.options.status_check'))->rules('required');
      
            $row->width(12)->textarea('remark','備注');
        });

    
        
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        $id = $this->payload['id'] ?? null;

        $log = MemberChangeLevel::find($id);
        $member = Member::find($log->user_id);
        return  compact('log','member');

    }
}   
