<?php
return [
    'labels'=>[
        'Member'=>'會員',
        'members'=>'會員'
    ],
    'fields' => [
        'chiname'  => '中文姓名',
        'engname'   => '英文姓名',
        'phone' => '手提電話',
        'email' => '個人電郵',
        'member_type' => '會員類型',
        'job_type' => '類別',
        'company' => '工作機構',
        'job_name' => '職位',
        'company_type' => '種 類',
        'recommender' => '推薦人',
        'status' => '狀態',
        'card_img' => '會員卡',
        'created_at'=> '申請時間',
        'updated_at'=> '更新時間',
        'card_no_txt'=>'編號',
        'actions'=>'',
        'member_expired_at'=>'到期時間',
    ],
    'options'=>[
        'status_check'=>[
            1=>'通過',
            '2'=>'拒絕'
        ],
        'status'=>[
            0=>'待審核',
            1=>'已審核',
            2=>'已拒絕'
        ],
        'member_type'=>[
            1=>'普通會員',
            '2'=>'資深會員',
            '3'=>'永久會員',
            '4'=>'附屬會員'
        ],
        'job_type'=>[
            0=>'无',
            1=>'現職教師',
            2=>'準教師',
            3=>'教育相關',
            4=>'退休教師'
        ],
        'company_type'=>[
            0=>'暫無',
            1=>'幼稚園',
            2=>'小學',
            3=>'中學',
            4=>'大學'
        ],

    ],
];
