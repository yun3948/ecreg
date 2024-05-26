<?php

namespace App\Admin\Actions\Grid;

use App\Mail\MemberExpiredNotice;
use App\Models\Member;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendExpireEmailBtn extends RowAction
{
    /**
     * @return string
     */
    protected $title = '發送續費提醒';

    public function title()
    {
        return <<<HTML
        <i class="fa fa-send"> {$this->title}</i>
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
        // dump($this->getKey());
        $member_id = $this->getKey();
        $member = Member::find($member_id);

        // 发送过期提醒通知邮件
        Mail::to($member)->send(new MemberExpiredNotice($member));

        return $this->response()
            ->success('發送成功！ ')
            ->refresh('/');
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return ['確認發送?', ''];
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
    protected function parameters()
    {
        return [];
    }
}
