<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MemberChangeLevelLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MemberChangeLevelLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MemberChangeLevelLog(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_id');
            $grid->column('member_type');
            $grid->column('email');
            $grid->column('action_type');
            $grid->column('remark');
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
        return Show::make($id, new MemberChangeLevelLog(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('member_type');
            $show->field('email');
            $show->field('action_type');
            $show->field('remark');
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
        return Form::make(new MemberChangeLevelLog(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('member_type');
            $form->text('email');
            $form->text('action_type');
            $form->text('remark');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
