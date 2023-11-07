<?php

namespace App\Admin\Actions\Grid;

use App\Mail\MemberCard as MemberCardMail;
use App\Models\Member;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendCardBtn extends RowAction
{
    /**
     * @return string
     */
    protected $title = '發送會員卡';

    protected $model;

    public function __construct(string $model = null)
    {
        $this->model = $model;
    }

    public function title()
    {
        return $this->title;
    }

    protected function html()
    {

        return <<<HTML
        <i class="fa fa-credit-card-alt">{$this->title}</i>
HTML;
    }


    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // 获取当前行ID
        $id = $this->getKey();

        $member = Member::find($id);
        // 发送通知邮件
        Mail::to($member->email)->send(new MemberCardMail($member));

        return $this->response()
            ->success('發送完成！ ')
            ->refresh();
    }


    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['確認發送？'];
        // return ['Confirm?', 'contents'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    /**
     * 设置要POST到接口的数据
     *
     * @return array
     */
    public function parameters()
    {
        return [
            // 发送当前行 ID 字段数据到接口
            //            'id' => $this->row->id,

        ];
    }
}
