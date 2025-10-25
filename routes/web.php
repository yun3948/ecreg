<?php

use App\Http\Controllers\UserController;
use App\Models\Member;
use App\Models\MemberChangeLevel;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/test/test',[\App\Http\Controllers\TestController::class,'test']);

// 会员申请
Route::prefix('/register')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/general/{type}', [\App\Http\Controllers\HomeController::class, 'general'])->name('register.show');
    Route::post('/general/{type}', [\App\Http\Controllers\HomeController::class, 'save_general'])->name('register.post');
    Route::post('/send_check_mail', [\App\Http\Controllers\HomeController::class, 'send_check_mail'])->name('register.send_check_mail');
});

//邮箱确认
Route::get('/email_confirm/{user_id}', [\App\Http\Controllers\HomeController::class, 'email_confirm'])->name('email_confirm');

// 会员确认
Route::get('/member/vertify', [\App\Http\Controllers\BindController::class, 'vertify_view']);
Route::post('/member/vertify', [\App\Http\Controllers\BindController::class, 'vertify_code']);

//会员信息
Route::get('/member/info', [\App\Http\Controllers\BindController::class, 'member_info']);
Route::post('/member/info', [\App\Http\Controllers\BindController::class, 'update_member_info']);

//登录
// Route::get('/login',function(){
//     return view('login');
// });

// Route::post('/login',[\App\Http\LoginController::class,'login']);

//重写忘记密码 修改用户搜索条件
Route::post('/forgot-password', [\App\Http\Controllers\LoginController::class, 'send_reset_passwd_link'])
    ->middleware(['guest:' . config('fortify.guard')])
    ->name('password.email');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('user')->group(function () {

    Route::get('/info', function () {
        return view('user.member_info', [
            'member' => Auth::user()
        ]);
    })->name('user.info');

    Route::post('/info', [UserController::class, 'save_info']);

    Route::get('/card', function () {
        return view('user.member_card', [
            'member' => Auth::user()
        ]);
    })->name('user.card');

    Route::post('/card', [UserController::class, 'send_card']);

    Route::get('/level',[UserController::class, 'level'])->name('user.level');


    Route::post('/level', [UserController::class, 'change_level']);

    // Route::get('/news',function(){
    //     return view('user.member_news',[
    //         'member'=>Auth::user()
    //     ]);
    // })->name('user.news');

    Route::get('/news', [UserController::class, 'news'])->name('user.news');


    Route::get('/password', function () {
        return view('user.member_password', [
            'member' => Auth::user()
        ]);
    })->name('user.password');

    Route::post('/password', [UserController::class, 'save_password']);
});
