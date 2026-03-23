<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\MemberEditTypeForm;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;

class MemberEditTypeBtn extends RowAction
{
    protected $title = '會員编辑';



    public function render()
    {
        $form = MemberEditTypeForm::make()->payload(['id' => $this->getKey()]);

        return Modal::make()
            ->lg()
            ->title('會員編輯')
            ->body($form)
            ->button("<a style='display:block;width:100%;text-align:left;cursor:pointer;'><i class='feather icon-edit'></i>&nbsp;" . __('admin.edit') . "</a>");
    }
}
