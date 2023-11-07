<?php

namespace App\Http\Controllers;

use App\Mail\SendUpdateLink;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BindController extends Controller
{

    public function vertify_view(){
        return view('member_info.vertify');
    }

    //提交信息 验证无误后发送修改连接倒用户邮箱。 用户点击邮箱 跳转
     public function vertify_code(Request $request) {
        // 验证用户提交信息
         $validate = $request->validate([
             'chiname'=>'required',
             'email'=>'bail|required|email:rfc,dns'
         ],[
//            'email.email'=>'请输入一个合法的邮箱地址'
         ],
         [
//            'chiname'=>'姓名',
//             'email'=>'邮箱'
         ]);



         //查询数据 判断是否存在
         $email = $request->input('email');
         $chiname = $request->input('chiname');
         $member = Member::where('email',$email)->where('chiname',$chiname)->first();
         //不存在 返回错误
         if(empty($member)) {

             return back()->withInput()->withErrors(['msg' =>__('message.bind_no_user')]);
         }

         //信息正确则发送邮件到用户邮箱
         //随机生成code
         $code = Str::random(16);
         //更新用户
         $member->vertify_code = $code;
         $member->vertify_code_time = time();
         $member->Save();

         Mail::to($member->email)->send(new SendUpdateLink($member));
         return back()->with('success',__('message.bind_succ'));
     }

      // 获取基础信息
     public function member_info(Request $request){

        $member = $this->check_code();

        if($member == false) {
            return  ['error'=>1,'msg'=>__('message.error')];
        }

         $view = '';
         switch ($member->member_type){
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
         $code =  request()->input('code');

         return view($view,['member'=>$member,'code'=>$code]);
     }

     //提交更新信息  验证提交的信息
     public function update_member_info(Request $request){
         $member = $this->check_code();
         if($member == false) {
             return back()->withErrors(['msg'=>__('message.error')]);
         }

         $type = $member->member_type;
         $input = $request->all();

         $data = [];
         $data['chiname'] = $input['zh_name'];
         $data['engname'] = $input['en_name'];
         $data['phone'] = $input['mobile'];
         $data['email'] = $input['email'];
         $data['member_type'] = $type;

         //判断 phone 和 email 是否存在
         // 数据验证
         $message = [];
         $attribute = [
//             'chiname'=>'中文姓名',
//             'engname'=>'英文姓名',
//             'phone'=>'手提電話',
//             'email'=>'電郵'
         ];
         $validator = Validator::make($data, [
             'chiname' => 'required|min:2|max:10',
             'engname'=>'required|min:2|max:30',
             'phone'=>'required|unique:members',
             'email'=>'required|email:rfc,dns|unique:members'

         ],$message,$attribute);

         if($validator->fails()) {
             $errors = $validator->errors();
             $msg = $errors->first();
             return ['error'=>1,'msg'=>$msg];
         }

         //组织数据
         switch ($type) {
             case '1':
                 //$workerinfo  下标和字段下表对应
                 $company_field = [1=>'teach-school',2=>'study-school',3=>'work-school',4=>'pre-school'];
                 $workerinfo = $input['workerinfo'];
                 $data['job_type'] = $workerinfo;
                 $job_field = $company_field[$workerinfo];
                 $data['company'] =$input[$job_field] ;
//                 $data['status'] = 1;
                 break;
             case '2':
             case '3':
                 $company_field = [1=>'pre-school',2=>'work-school'];
                 $workerinfo = $input['workerinfo'];
                 $data['job_type'] = $workerinfo;
                 $job_field = $company_field[$workerinfo];
                 $data['company'] =$input[$job_field] ;
                 $data['tuijianren'] = $input['tuijianren'];
//                 $data['status'] = 0;
                 break;

             case '4':
//                 $data['status'] = 1;
                 break;
         }


         // 更新数据
         $member = Member::where('id',$member->id)->update($data);

          return ['error'=>1,'msg'=>__('message.bind_update_succ')];

     }

    // 验证code 是否有效
     public function check_code(){

         $code =  request()->input('code');

        if(empty($code)) {
            return false;
        }

        $member = Member::where('vertify_code',$code)->first();

        if(empty($member)) {
            return false;
        }

        //判断时间是否过期 30 分钟内有效
         if(time() - $member['vertify_code_time'] >30*60) {
//            return false;
         }

         return $member;
     }

}
