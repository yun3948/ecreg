<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MemberLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

use Dcat\Admin\Layout\Content;
class MemberLogController extends AdminController
{
    protected $title = '會員記錄';

    protected $type;
    public function mail_log(Content $content)
    {
        $this->title = '電郵記錄';

        $this->type = 'mail';
        return $content
        ->translation($this->translation())
        ->title($this->title())
        ->description($this->description()['index'] ?? trans('admin.list'))
        ->body($this->grid());
        // return redirect(admin_route('member_log', ['type' => 'mail']));

          
    }

    public function level_log(Content $content)
    {
        $this->title = '會員等級變動記錄';

        $this->type = 'level';
        return $content
        ->translation($this->translation())
        ->title($this->title())
        ->description($this->description()['index'] ?? trans('admin.list'))
        ->body($this->grid());
        // return redirect(admin_route('member_log', ['type' => 'level']));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
      

        return Grid::make(new MemberLog(), function (Grid $grid) {
            $model = $grid->model();
            $model->orderBy('id', 'DESC');

            if(!empty($this->type)) {
                $model->where('type',$this->type);
            }

            $grid->column('id')->sortable();
            $grid->column('member_id');
            $grid->column('email');
            $grid->column('message');
            $grid->column('type');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new MemberLog(), function (Show $show) {
            $show->field('id');
            $show->field('member_id');
            $show->field('email');
            $show->field('message');
            $show->field('type');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new MemberLog(), function (Form $form) {
            $form->display('id');
            $form->text('member_id');
            $form->text('email');
            $form->text('message');
            $form->text('type');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
