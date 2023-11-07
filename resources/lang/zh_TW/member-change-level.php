<?php 
return [
    'labels' => [
        'MemberChangeLevel' => '會員變更審核',
        'member-change-level' => '會員變更審核',
    ],
    'fields' => [
        'user_id' => '會員ID',
        'email' => '電郵',
        'member_type' => '會員類型',
        'action_type' => '申請類型',
        'status' => '審核狀態',
        'remark' => '備注',
    ],
    'options' => [
        'status'=>[
            0=>'待審核',
            1=>'已審核',
            2=>'已拒絕'
        ],
    ],
];
