<?php

namespace App\Http\Controllers;

use App\Mail\UserSendMemberCard;
use App\Models\Member;
use App\Models\MemberChangeLevel;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function home()
    {

    }

    public function level(Request $request) {
        $user_id = Auth::id();
        $member = Member::find(Auth::id());
        $log = MemberChangeLevel::where('user_id',$user_id)
        // ->where('status',0)
        ->orderByDesc('id')
        ->first(); 
        // 存在申請記錄 并且記錄狀態為 未審核 則 is_check = 1
        return view('user.member_level',[
            'member'=>$member,
            'is_check'=> ($log && $log->status == 0)?1:0, // 等待审核
            'is_pass'=> ( $member->type ==3 || ($log && $log->status == 1))?1:0 // 申请过并且通过
        ]);
    }

    //申請永久会员
    public function change_level(Request $request){
       
        //判斷是否存在申請
        $user_id = Auth::id();

        $user = Auth::user(); 

        $data = [];
        $data['user_id'] = $user_id;

      
        //判断是否存在未操作的记录
        $log = MemberChangeLevel::where('user_id',$user_id)->where('status',0)->first();

        if(!empty($log)) {
            return back()->with('error','已申請，等待審核中');
        }

        //插入记录
        MemberChangeLevel::create([
            'user_id'=>$user_id,
            'email'=>$user->email,
            'member_type'=>MEMBER_TYPE_ARR[$user->member_type],
            'action_type'=>'永久會員',
            'status'=>0,
            'remark'=>'申请永久会员·'

        ]);


        return back()->with('success','申請成功，等待管理員審核！');
        
    }

    //新聞
    public function news(){
       $list =  News::where([])->simplePaginate(10);

       return view('user/member_news',[
        'list'=>$list
       ]);

    }

    // 重置密碼
    public function save_password(Request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                'current_password'
            ],
            'password'=>'required|min:8|confirmed'
        ]);

        $password = $request->input('password');
        $user = Auth::user();
        $user->password = Hash::make($password);
        $user->save();
        return back()->with('message','保存成功');
        
    }

    // 发送邮件
    public function send_card(Request $request){
        $user = Auth::user();
      
        Mail::to($request->user())->send(new UserSendMemberCard($user));
 
        return redirect()->back()->with('message', '電子會員證已發送，請登入郵箱查收。如沒有收到郵件，請檢查「垃圾郵件」並把本會發出的電郵設成「非垃圾郵件」'); 
    }

    // 保存修改信息
    public function save_info(Request $request)
    {

        $input = $request->all();
   
      

        $data = [];
        $data['chiname'] = $input['zh_name'];
        $data['engname'] = $input['en_name'];
        $data['phone'] = $input['mobile'];
        $data['email'] = $input['email'];

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
            'chiname' => 'required|min:2|max:6|regex:/^[\x{4e00}-\x{9fa5}]+$/u',

            // 'password'=>'required|min:8|max:20',
            'phone' => [
                'required',
                // Rule::unique('members')->where(function($query){
                //     $query->where('deleted_at',null)->where('status',1);
                // }),
            ],

            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('members')->where(function ($query) {
                    // 排除当前用户
                    $query->where('deleted_at', null)->where('id', '!=', Auth::id());
                }),
            ],
            'workerinfo' => 'required',
            'job_name' => 'required',
        ];

        $user = Auth::user();
        switch ($user['member_type']) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                unset($rules['workerinfo']);
                unset($rules['job_name']);
                break;
        }

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        unset($data['workerinfo']);
        $company_field = [1 => 'teach-school', 2 => 'study-school', 3 => 'work-school', 4 => 'pre-school'];
        $workerinfo = $input['workerinfo'];

        $data['job_type'] = $workerinfo;
        $job_field = $company_field[$workerinfo];
        $data['company'] = $input[$job_field];
        $data['company_type'] = $input['company_type'];

        unset($data['workerinfo']);


        // 判断邮箱是否修改  记录日志        
        if($user->email != $data['email']) {
            
        } 

        Member::query()->where('id', Auth::id())->update($data);

        return redirect()->back()->with('message', '資料更新成功。');
    }
}
