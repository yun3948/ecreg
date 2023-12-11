<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\News;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class NewsController extends AdminController
{
    protected function title() {
        return '會員新聞';
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new News(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('remark');
            $grid->column('content');
            $grid->column('link');
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
        return Show::make($id, new News(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('remark');
            $show->field('content');
            $show->field('link');
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
        return Form::make(new News(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->textarea('remark');
            $form->url('link');
            $form->editor('content');
       
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
