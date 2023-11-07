<?php

namespace App\Http\Controllers;

use App\Events\MemberRegister;
use App\Http\Controllers\Controller;
use App\Mail\MemberConfirmMail ;
use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    // 重发
    public function resend_card(Request $request){
        return view('resend_card');
    }

    // 发送验证邮件
    public function send_check_mail(Request $request){
        $member_id = session('need_check_mail');
        if(empty($member_id)) {
            return ['error'=>1,'msg'=>'发生异常！'];
        }
        $member = Member::find($member_id);
        event(new MemberRegister($member));
        return ['error'=>0,'msg'=>'驗證郵件已發送到您的郵箱，敬請查收。'];

    }

    // 邮箱确认
    public function email_confirm(Request $request,$user_id)
    {
        // 验证签名
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        //签名验证成功  修改 会员状态
        $member = Member::find($user_id);

        if($member->status == 1) {
            return view('email_confirm_succ');
        }
        $member->email_verified_at = now();
        $member->status = 1; //改为已认证
        $member->save();

        // 验证成功 发送邮件
        Mail::to($member->email)->send(new MemberConfirmMail($member));

        //显示验证成功
        return view('email_confirm_succ');

    }

    //  注册
    public function general($type)
    {
        $view = '';
        switch ($type) {
            case '1':
                $view = 'general-normal';
                break;
            case '2':
                $view = 'general-zishen';
                break;
            case '3':
                $view = 'general-yongjiu';
                break;
            case '4':
                $view = 'general-fushu';
                break;
        }
        $member = new Member();
        $check_email_url = route('register.send_check_mail');
        return view($view, ['member' => $member, 'code' => '','check_email_url'=>$check_email_url]);

    }

    // 保存注册信息
    public function save_general(Request $request, $type)
    {

//        event(new MemberRegister(Member::find(11)));

        $input = $request->all();

        $data = [];
        $data['chiname'] = $input['zh_name'];
        $data['engname'] = $input['en_name'];
        $data['phone'] = $input['mobile'];
        $data['email'] = $input['email'];
        $data['member_type'] = $type;
        $data['workerinfo'] = $input['workerinfo'] ?? '';
        $data['job_name'] = $input['job_name'] ?? '';
        //判断 phone 和 email 是否存在
        // 数据验证
        $message = [];
        $attribute = [
            // 'password'=>'密碼',
            'workerinfo' => '工作狀況'
        ];

        //默认所有字段都需要

        $rules = [
            'engname' => 'required|min:2|max:30|regex:/^[a-zA-Z ]+$/',
            'chiname' =>'required|min:2|max:6|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            'password'=>'required|min:8|max:20',
            'phone' =>[
                'required',
                // Rule::unique('members')->where(function($query){
                //     $query->where('deleted_at',null)->where('status',1);
                // }),
            ],

            'email'=>[
                'required',
                'email:rfc,dns',
//                Rule::unique('members')->where(function($query){
//                    $query->where('deleted_at',null);
//                }),
            ],
            'workerinfo' => 'required',
            'job_name' => 'required',
        ];


        switch ($type) {
            case 1:
                break;
            case 2:
                break;
            case 3 :
                break;
            case 4:
                unset($rules['workerinfo']);
                unset($rules['job_name']);
                break;

        }

        $validator = Validator::make($data, $rules, $message, $attribute);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $msg = $errors->first();

            return ['error' => 1, 'msg' => $msg];
        }

        //手动验证 邮箱 和电话 。非后台审核的 提示用户继续验证
        //判断是否存在
        $res = Member::where('email',$data['email'])->first();

        if($res) {
            // 已存在且已审核
            if($res->status) {
                $msg = '郵箱已注冊！';
               

                // 普通会员
                if($data['member_type'] == 1) {
                    $msg = '電郵已使用，不能重複註冊，可登入修改資料!';
                }

                // 资深会员
                if($data['member_type'] == 2) {
                    $msg = '電郵已使用，可登入後申請升級!';
                } 


                return ['error'=>1,'msg'=>$msg];
            }else{
                if(in_array($data['member_type'],[1,4])) {
                    //普通會員  提醒再次發送激活郵件

                    session(['need_check_mail'=>$res->id]);

                    return ['error'=>1,'msg'=>'您的電郵尚未通過驗證，請按電郵中的指示驗證電郵地址。','need_check'=>1];
                }else{
                    //未審核收費會員 提醒後臺審核
                    return ['error'=>1,'msg'=>'提示: 您早前已提交註冊表單，請耐心等候專人通知辦理入會事宜。如超過一個月仍未收到消息，請致電或以電郵聯絡我們。'];
                }
            }

        }

        unset($data['workerinfo']);

       
        //组织数据
        switch ($type) {
            case '1':
                //$workerinfo  下标和字段下表对应
                $company_field = [1 => 'teach-school', 2 => 'study-school', 3 => 'work-school', 4 => 'pre-school'];
                $workerinfo = $input['workerinfo'];

                $data['job_type'] = $workerinfo;
                $job_field = $company_field[$workerinfo];
                $data['company'] = $input[$job_field];
                $data['status'] = 0;
                break;
            case '2':
            case '3':
                $company_field = [4 => 'pre-school', 3 => 'work-school'];
                $workerinfo = $input['workerinfo'];
                $data['job_type'] = $workerinfo;
                $job_field = $company_field[$workerinfo];
                $data['company'] = $input[$job_field];
                $data['company_type'] = $input['company_type'];
                $data['recommender'] = $input['recommender'];
                $data['status'] = 0;
                break;

            case '4':
                $data['status'] = 0;
                break;
        }

        // 密码加密
        $data['password'] = Hash::make($data['password']);

        //设置过期时间
        $data['member_expired_at'] = Carbon::now()->addDays(365);//默认过期时间为 365天以后

        $member = Member::create($data);

//        dd($member);
        // 触发注册事件
//        event(new MemberRegister(Member::find(11)));
        event(new MemberRegister($member));

        return ['error' => 0, 'msg' => '', 'data' => []];
    }

}
