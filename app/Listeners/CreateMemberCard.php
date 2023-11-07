<?php

namespace App\Listeners;

use App\Events\MemberCheck;
use App\Events\MemberRegister;
use App\Models\Member;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

use Image;
use DNS1D;
use Storage;


class CreateMemberCard implements ShouldQueue
{
    public $queue = 'listeners';
    public $delay = 60;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\MemberRegister $event
     * @return void
     */
    public function handle($event)
    {
        $member = $event->member;
        //生成卡片 并保存

//        $img = Image::canvas($canvas_width, $canvas_height, '#eeeeee');
        $card_type = match($member->member_type){
            1=>'normal',
            2=>'zishen',
            3=>'yongjiu',
            4=>'fushu'
        };

        switch ($member->member_type){
            case 1:
                $card_type = 'normal';
                break;
            case 2:
                $card_type = 'zishen';
                break;
            case 3:
                $card_type = 'yongjiu';
                break;
            case 4:
                $card_type = 'fushu';
                break;
        }


        $img = Image::make(public_path("card/bg/{$card_type}.png"));


        $font_file = public_path('/card/msjhbd.ttc');

        //姓名
        if(!empty($member->chiname)) {
            $name = $member->chiname;
        }else{
            $name = $member->engname;
        }
        $name_txt = "姓　　名 : {$member->chiname} ({$member->engname})";
        $img->text($name_txt, 60, 250, function ($font) use ($font_file) {
            $font->file($font_file);
            $font->size(40);
            $font->color('#000000');
//            $font->align('center');
            $font->valign('top');

        });

        $no_txt =  $this->create_card_no($member);
        $m_no_txt = "會員編號 : {$no_txt}";
        $img->text($m_no_txt, 60, 310, function ($font) use ($font_file) {
            $font->file($font_file);
            $font->size(40);
            $font->color('#000000');
//            $font->align('center');
            $font->valign('top');

        });

        //会员证类型  附屬會員證
        $member_type_txt = "會員類別 : ".MEMBER_TYPE_ARR[$member->member_type];
        //写入文字
        $img->text($member_type_txt, 60, 370, function ($font) use ($font_file) {
            $font->file($font_file);
            $font->size(40);
            $font->color('#000000');
//            $font->align('center');
            $font->valign('top');
        });

        $txt = "有效期至 : ".date('d-m-Y',strtotime('+1 year'));
        $img->text($txt, 60, 430, function ($font) use ($font_file) {
            $font->file($font_file);
            $font->size(40);
            $font->color('#000000');
//            $font->align('center');
            $font->valign('top');
        });

        // 画矩形
        $rect_img = Image::canvas(410, 125);
        $rect_img->fill('#fff');

        // 生成一维码
        $barImg = DNS1D::getBarcodePNGPath($no_txt, 'C39+', 5, 60);
        $barImg = public_path($barImg);
        $barImg = Image::make($barImg)->resize(335,95);
        $rect_img->insert($barImg,'center');

        //插入一维码
        $img->insert($rect_img, 'bottom-right', 30, 30);

        // 路径
        $path = 'card/' . date('Y/m/') . md5($no_txt) . '.png';
        Storage::disk('public')->put($path, (string)$img->encode('png'));
        $card_img = Storage::url($path);

        //更新 用户 card_img
        $member->card_img = $card_img;
        $member->save();
    }

    //生成会员卡号
    private function create_card_no(Member $member)
    {
        $card_no = 300;
        //获取比当前member  ID 小的数据数量
        $member_sort = Member::where('id','<',$member->id)->count();

        $card_no = $card_no + $member_sort;

        $str = str_pad($card_no,6,'0',STR_PAD_LEFT);

        $tmp_arr = str_split($str);
        $str_total = (string)array_sum($tmp_arr);
        //获取最后一位
        $last_str = substr($str_total,-1);

        return "{$str}$last_str";
    }
}
