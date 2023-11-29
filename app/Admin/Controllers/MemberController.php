<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SendCardBtn;
use App\Admin\Repositories\Member;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Member as MemberModel;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Dcat\Admin\Widgets\Tab;

use App\Admin\Actions\Grid\MemberCheckBtn;
use App\Admin\Actions\Grid\MemberRenewalBtn;

class MemberController extends AdminController
{

 
    //待审核会员列表
    protected function check_member_list()
    {
        return redirect(admin_route('member_list', ['is_check' => 1]));
    }
 

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $this->title = '會員列表';


        $grid =  Grid::make(new Member(), function (Grid $grid) {

            $member_type = request()->input('member_type'); 

            //设置header
            if (request()->has('member_type')) {
                $grid->header(function () use ($member_type) {
                    $tab  = Tab::make();
                    $type_list = MEMBER_TYPE_ARR;
                    array_unshift($type_list, '全部');
                    foreach ($type_list as $key => $value) {
                        $tab->addLink($value, "?member_type={$key}", $member_type == $key ? true : false);
                    }

                    return $tab;
                });
            }

            // 显示待审核
            if(request()->has('is_check')){
                $grid->header(function(){
                    $tab = Tab::make();
                    $tab->addLink('會員注冊申請',admin_route('member.check'),1);
                    $tab->addLink('會員升級申請',admin_route('member.check_level'),0);
                    return $tab;
                });
            };




            $model = $grid->model()->orderBy('id', 'DESC');
            // $grid->model()->orderBy('id', 'DESC');

            if (!empty($member_type)) {
                $model->where('member_type', $member_type);
            }


            if (!request()->has('is_check')) {
                $is_check_member = 0;
                $model->where('status', 1);
            } else {
                $is_check_member = 1;
                // 需要审核的会员 设置类型为 2 3
                $model->where('status', 0)->whereIn('member_type', [2, 3]);
                //  $grid->model()->orderBy('member_type','DESC')->orderBy('id','desc');
            }


            //默认 参数 status
            //切换按钮显示方式
            //  $grid->setActionClass(Grid\Displayers\Actions::class);



            // $grid->model()->orderBy('id', 'DESC');
            $is_check_member = 0;

            if (request()->has('is_check')) {
                $is_check_member = 1;
            }



            // 添加审核按钮
            // $grid->actions(new CheckRow());

            $grid->disableEditButton();
            if ($is_check_member) {
                $grid->disableViewButton();
                $grid->actions([new MemberCheckBtn()]);
            }


            if (!$is_check_member) {
                // $grid->disableDeleteButton();
                $grid->showQuickEditButton(); 

                $grid->actions([
                    new SendCardBtn(),
                    new MemberRenewalBtn()
                   
                ]);
            }




            $grid->column('id')->sortable();
            $grid->column('chiname');
            $grid->column('engname');
            $grid->column('phone');
            $grid->column('email');
            $grid->column('member_type')->display(function () {
                return admin_trans_option($this->member_type, 'member_type');
                //                return MEMBER_TYPE_ARR[$this->member_type];
            });

            $grid->column('job_type')->display(function () {
                return admin_trans_option($this->job_type, 'job_type');
            });
            //            $grid->column('company');
            $grid->column('job_name');
            //            $grid->column('company_type');
            //            $grid->column('recommender');
            $grid->column('status')->display(function () {
                return admin_trans_option($this->status, 'status');
            });

            $grid->column('card_img')->image('/', 60, 60);

            if(!request()->has('is_check')) {
                $grid->column('member_expired_at','到期時間')->sortable();;
            }else{
                $grid->column('created_at')->sortable();;
            }
         
            
            //            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('chiname')->width(6);
                $filter->like('engname')->width(6);
                $filter->like('phone')->width(6);
                $filter->like('email')->width(6);
                $filter->equal('status')->select([
                    0 => '待審核',
                    1 => '已通過'
                ])->width(3);
            });

            $grid->export()->disableExportSelectedRow();
            $grid->export()->disableExportCurrentPage();
            $grid->export()->xlsx();
            $titles = [
                'id' => 'ID',
                'chiname' => admin_trans_field('chiname'),
                'engname' => admin_trans_field('engname'),
                'phone' => admin_trans_field('phone'),
                'email' => admin_trans_field('email'),
                'member_type' => admin_trans_field('member_type'),
                'card_no_txt' => admin_trans_field('card_no_txt'),
                'job_type' => admin_trans_field('job_type'),
                'company' => admin_trans_field('company'),
                'job_name' => admin_trans_field('job_name'),
                'company_type' => admin_trans_field('company_type'),

                'created_at' => admin_trans_field('created_at'),
            ];

            $grid->export()->titles($titles);

            $grid->export()->rows(function ($rows) {
                foreach ($rows as $index => &$row) {
                    $row['job_type'] =  admin_trans_option($row['job_type'], 'job_type');
                    $row['member_type'] =  admin_trans_option($row['member_type'], 'member_type');
                    $row['company_type'] =  admin_trans_option($row['company_type'], 'company_type');
                }

                return $rows;
            });
        });


        return $grid;
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
        return Show::make($id, new Member(), function (Show $show) {

            $show->panel()
                ->tools(function ($tools) {
                    //                    $tools->disableEdit();
                    //                    $tools->disableList();
                    $tools->disableDelete();
                    // 显示快捷编辑按钮
                    //                    $tools->showQuickEdit();
                });


            $show->row(function (Show\Row $show) {
                $show->width(6)->field('chiname');
                $show->width(6)->field('engname');

                $show->width(6)->field('phone');
                $show->width(6)->field('email');

                $show->member_type()->using(admin_trans('member.options.member_type'));;

                $show->job_type()->using(admin_trans('member.options.job_type'));

                $show->field('company');

                $show->field('job_name');

                $show->company_type()->using(admin_trans('member.options.company_type'));

                $show->field('recommender');

                $show->status()->using(admin_trans('member.options.status'));
            });

            $show->divider();
            $show->newline();
            $show->row(function (Show\Row $show) {
                //                $show->width(5)->image->image();
                $show->width(6)->created_at;
                $show->width(6)->updated_at;
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Member(), function (Form $form) {
            $form->disableDeleteButton();

            $form->column(6, function (Form $form) {
                $form->text('chiname')->rules('required');

                $form->text('phone');//->rules("required|unique:members,phone,{$form->model()->id}");

                $form->text('company');

                $form->select('job_type')->options(admin_trans('member.options.job_type'));

                $form->select('member_type')->options(admin_trans('member.options.member_type'));

                $form->text('recommender');

                $form->text('card_no_txt');
            });

            $form->column(6, function (Form $form) {

                $form->text('engname')->rules('required');;

                $form->email('email');//->rules("required|unique:members,email,{$form->model()->id}");;

                $form->select('company_type')->options(admin_trans('member.options.company_type'));


                $form->text('job_name');

                $form->select('status')->options(admin_trans('member.options.status'))->disable();

                $form->display('created_at');

                $form->display('updated_at');
            });

            $form->width(8, 4);

            //            $form->ignore(['status']);

          

            // 需要判断是否重复
            $form->confirm('確認操作？');

            $form->saving(function (Form $form) {
                $form->deleteInput('status');
            });
        });
    }
}
