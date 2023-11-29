<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\MemberLevelCheckBtn;
use App\Admin\Repositories\MemberChangeLevel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Tab;
class MemberChangeLevelController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MemberChangeLevel('member'), function (Grid $grid) {

            $grid->disableEditButton();
            $grid->disableViewButton();

            $grid->actions([new MemberLevelCheckBtn()]);

            $grid->model()->where('status',0)->orderBy('id','DESC');

            $grid->header(function(){
                $tab = Tab::make();
                $tab->addLink('會員注冊申請',admin_route('member.check'), false );
                $tab->addLink('會員升級申請',admin_route('member.check_level'),true);
                return $tab;
            });

            $grid->column('id')->sortable();
            // $grid->column('user_id');
            $grid->column('member.chiname','姓名');
            $grid->column('email');
            $grid->column('member_type');
            $grid->column('action_type');
            $grid->column('status')->display(function () {
                return admin_trans_option($this->status, 'status');
            });
            // $grid->column('remark');
            $grid->column('created_at')->sortable();
            // $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                // $filter->equal('user_id');
            
        
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
        return Show::make($id, new MemberChangeLevel(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('email');
            $show->field('member_type');
            $show->field('action_type');
            $show->field('status');
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
        return Form::make(new MemberChangeLevel(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('email');
            $form->text('member_type');
            $form->text('action_type');
            $form->text('status');
            $form->text('remark');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
