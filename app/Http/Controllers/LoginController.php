<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{

    // 发送重置密码邮件链接
    public function send_reset_passwd_link(Request $request){
        $request->validate(['email' => 'required|email']);
      
        // 条件需要增加邮箱用户状态。程序可能存在邮箱重复问题
        $email = $request->input('email');
   
        
        $status = Password::sendResetLink([
            'email'=>$email,
            'status'=> 1,
        ] );
     
 
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);    
 
    }

    // 用户登录
    public function login(Request $request){
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

         

        $credentials = $request->only('email', 'password');
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        $user = Member::query()->where('email')->where('status',1)->first();
        if(empty($user)) {

        }

        //比较密码
        if($user->password != md5($password)) {

        }

        if(Auth::attempt($credentials)) {
            return redirect()->intended('/user_home');
        }
    }


    
}
