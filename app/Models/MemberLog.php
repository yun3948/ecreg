<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class MemberLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'member_log';

    protected $guarded = [];

    // 记录日志
    protected function log($member_id,$message,$remark,$type='info'){
        $member = Member::find($member_id);
        $log = new self();
        $log->member_id  = $member_id;
        $log->email = $member->email;
        $log->message = $message;
        $log->content = $remark;
        $log->type = $type;
        $log->save();
    }

    // 等级日志
    protected function level_log($member_id,$message,$remark='') {
        $member = Member::find($member_id);
        $log = new self();
        $log->member_id = $member_id;
        $log->email = $member->email;
        $log->type = 'level';

        $log->message = $message;
        $log->content = $remark;
        $log->save();
    }

    /// 邮件日志
    private function mail_log($member_id,$title,$message,$content) {
        
        
    }
    
}
