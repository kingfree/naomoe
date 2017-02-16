<?php

namespace App\Admin\Controllers;

use App\Competition;
use App\User;
use App\VoteLog;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class VoteLogController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('投票记录');
            $content->description('用户每次投票的记录，可以标记多重');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑投票记录');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('创建投票记录');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(VoteLog::class, function (Grid $grid) {
            $grid->disableCreation();
            $grid->actions(function ($actions) {
                //$actions->disableDelete();
                $actions->disableEdit();
            });

            $grid->id('ID')->sortable();
            $grid->column('user_id', '用户')->display(function ($id) {
                return User::find($id)->name;
            })->sortable();
            $grid->column('competition_id', '比赛')->display(function ($id) {
                return Competition::find($id)->title;
            })->sortable();
            $grid->column('ip', 'IP');
            $grid->column('header', '请求头部');
            $grid->column('body', '请求体');
            $grid->valid('有效票')->switch();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(VoteLog::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
