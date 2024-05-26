<?php

namespace App\Logic;

use App\Models\ExpireMember;
use App\Models\Member;

class MemberLogic
{


    //自身会员过期 或者 距离过期 30天以内  type 0 是即将过期  1 是已过期
    public function member_expire($member_id, $type = 0)
    {
        $member = Member::find($member_id);

        // 资深会员 
        if ($member->member_type != 2) {
            return;
        }

        // 判断是否存在。 不存咋则新增
        $res = ExpireMember::query()->where('member_id', $member_id)->first();

        ExpireMember::updateOrCreate([
            'member_id' => $member_id
        ], [
            'type' => $type,
            'member_expired_at' => $member->member_expired_at
        ]);

        return true;
    }

    // 续费成功 移除日志记录
    public function member_efect($member_id)
    {
        ExpireMember::query()->where('member_id', $member_id)->delete();
        return true;
    }

    //移除记录日志
    public function remove_expire_log($member_id)
    {
        ExpireMember::query()->where('member_id', $member_id)->delete();
        return true;
    }
}
