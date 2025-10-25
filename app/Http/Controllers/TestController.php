<?php

namespace App\Http\Controllers;

use App\Jobs\MemberCard;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
     public function test()
     {

         // 查询重复的 卡号会员
//            $member_list = Member::where('id',183)->get();

        $member_list = Member::query()
            ->where('card_no_txt','!=','')
            ->select('id','card_no_txt',DB::raw('count(1) as t'))
            ->groupBy('card_no_txt')
            ->having('t','>',1)
            ->get();

         $member_list->each(function ($member) {
             dump($member->id,'--member-id----');
                // 清空重新生成
                $member->card_no_txt = '';
                $member->save();

                // 写入队列
                Bus::chain( [
                    new MemberCard($member),
                ])->dispatch();

            });
            return 'hello！';
     }

}
