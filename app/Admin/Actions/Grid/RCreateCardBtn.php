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
use Dcat\Admin\Widgets\Modal;
use Illuminate\Support\Facades\Bus;
use App\Jobs\MemberCard;

class RCreateCardBtn extends RowAction
{
    /**
     * @return string
     */
    protected $title = '重新生成會員證';

    // 定义一个唯一的Modal ID，防止页面多个按钮冲突
    protected $modalId = 'update-member-info-modal';


    public function title()
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
        $memberId =  $id = $this->getKey();

        $member = Member::find($id);

        // 同步执行

        MemberCard::dispatchSync($member);

//        Bus::chain([
//            //生成图片
//            new MemberCard($member),
//
//        ])->dispatch();




        $imageHtml = $this->generateMemberImage($memberId);

        return $this->response()
            ->success('重新生成會員證完成！ ')
            ->html($imageHtml);
    }


    /**
     * @return string|array|void
     */
    public function confirm()
    {

        return ['確認重新生成會員證？',];
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
            //  'id' => $this->row->id,
        ];
    }


    protected function generateMemberImage($memberId)
    {
        $member = Member::find($memberId);

        // 示例：返回一个简单的图片标签，实际可能是生成图片的URL
        // 你可以在这里调用服务类，生成图片并返回其HTML或URL
        $imageUrl = "{$member->card_img}&v=" . time();

        return "<div style='text-align: center;'><img src='{$imageUrl}' style='max-width: 100%;' /></div>";
    }

    /**
     * 处理前端收到响应后的行为
     * 这里自定义JS，用来接收后台返回的html内容并显示在弹窗中
     *
     * @return string
     */
    protected function handleHtmlResponse()
    {
        // 这个JS函数会在请求成功后执行
        // target: 触发按钮的jQuery对象
        // html: 后台返回的html内容
        // data: 完整的返回数据
        return <<<JS
function (target, html, data) {
    // 找到这个按钮专属的Modal容器
    var modal = $(target.data('target'));
    // 将返回的HTML设置到Modal的body中
    modal.find('.modal-body').html(html);
    // 显示Modal弹窗
    modal.modal('show');
}
JS;
    }

    /**
     * 设置按钮的HTML属性和弹窗容器
     */

    protected function setupHtmlAttributes()
    {
        // 给按钮添加样式
        // $this->addHtmlClass('btn btn-sm btn-primary');

        // 关键：设置一个自定义属性，用于关联这个按钮和它专属的Modal
        // 这里我们用一个唯一的Modal ID
        $this->setHtmlAttribute('data-target', '#' . $this->modalId);

        parent::setupHtmlAttributes();
    }

    /**
     * 渲染按钮和Modal容器
     * 注意：这里需要返回按钮的HTML + Modal容器的HTML
     */
    public function html()
    {
        // 1. 生成Modal容器
        $modal = Modal::make()
            ->lg() // 设置大尺寸弹窗
            ->title('會員證瀏覽') // 弹窗标题
            ->id($this->modalId) // 设置唯一的ID，用于与按钮关联
            ->body('<div style="text-align: center; padding: 20px;">加载中...</div>'); // 初始内容

        // 2. 返回按钮HTML + Modal容器HTML
        return parent::html() . $modal->render();
    }
}
