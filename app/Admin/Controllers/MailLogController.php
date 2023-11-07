<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\MailLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MailLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MailLog(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('mail');
            $grid->column('subject');
            $grid->column('content');
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
        return Show::make($id, new MailLog(), function (Show $show) {
            $show->field('id');
            $show->field('mail');
            $show->field('subject');
            $show->field('content');
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
        return Form::make(new MailLog(), function (Form $form) {
            $form->display('id');
            $form->text('mail');
            $form->text('subject');
            $form->text('content');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
