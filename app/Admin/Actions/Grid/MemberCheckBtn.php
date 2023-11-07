<?php

namespace App\Admin\Actions\Grid;


use Dcat\Admin\Grid\RowAction;
use App\Admin\Forms\MemeberCheck;
use Dcat\Admin\Widgets\Modal;



class MemberCheckBtn extends RowAction
{
    /**
     * @return string
     */
	protected $title = '點擊審核';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $form = MemeberCheck::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('审核')
            ->body($form)
            ->button("<i class='feather icon-user-check'></i>{$this->title}");
    }

}
