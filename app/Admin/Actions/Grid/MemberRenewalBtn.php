<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\MemberRenewalForm;
use App\Admin\Forms\MemeberCheck;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dcat\Admin\Traits\LazyWidget;
class MemberRenewalBtn extends RowAction
{
    /**
     * @return string
     */
    protected $title = '點擊續期';

  

    public function html()
    {
        // 实例化表单类并传递自定义参数
        $form = MemberRenewalForm::make()->payload(['id' => $this->getKey()]); 

        return Modal::make()
            ->title('會員續費')
            ->body($form)
            ->button("<i class='feather icon-user-check'></i>{$this->title}");
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
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
    protected function parameters()
    {
        return [];
    }
}
