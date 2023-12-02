<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', function (){
        return redirect(admin_route('member_list'));
    });

    $router->resource('members', 'MemberController',[
        'names'=>[
            'index'=>'member_list',
            ]
    ]);
    // 资深会员续期
    $router->get('wait_pay_members','MemberController@pay_member_list')->name('member.pay');
    
    // 审核列表
    $router->get('check_member_list','MemberController@check_member_list')->name('member.check');

    $router->post('check_member','MemberController@check_member');


    // 日志
    $router->resource('member_log', 'MemberLogController');

    //新聞
    $router->resource('member_news', 'NewsController');

    //等級變動  審核
    $router->resource('member_change_level','MemberChangeLevelController',[
        'names'=>[
            'index'=>'member.check_level'
        ]
    ]);



    //等級變動日志
    $router->resource('member_change_level_log','MemberChangeLevelLogController');

    //郵箱記錄
    $router->resource('mail_log','MailLogController');
 

});
