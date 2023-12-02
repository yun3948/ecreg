<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Member extends Model
{
    use SoftDeletes;
	use HasDateTimeFormatter;
    protected $guarded = [];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'member_expired_at' => 'datetime',
    ];

    public function getEngnameAttribute($val){
        return strtoupper($val);
    }

    // status 审核状态
    public function getStatusStrAttribute($val){
         if($val == '') {
             return $val;
         }

        return STATUS_ARR[$val];
    }

    //member_type 会员类型
    public function getMemberTypeStrAttribute() {
        
        $member_type = $this->member_type;
        
        if($member_type == '') {
            return ;
        }
        return MEMBER_TYPE_ARR[$member_type];
    }

    // job_type
    public function getJobTypeStrAttribute($val) {
        if($val == '') {
            return $val;
        }
        return JOB_TYPE_ARR[$val];
    }

    //company_type
    public function getCompanyTypeStrAttribute($val) {
        if($val == '') {
            return $val;
        }
        return COMPANY_TYPE_ARR[$val];
    }


 
}
