<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\MemberLevelCheckForm;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dcat\Admin\Widgets\Modal;
class MemberLevelCheckBtn extends RowAction
{
    /**
     * @return string
     */
	protected $title = '點擊審核';

    
    public function render()
    {
        // 实例化表单类并传递自定义参数
        $form = MemberLevelCheckForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('會員升級審核')
            ->body($form)
            ->button("<i class='feather icon-user-check'></i>{$this->title}");
    }
}
