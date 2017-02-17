<?php

namespace App\Admin\Controllers;

use App\Competition;
use App\Option;
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

//            $grid->column('user_id', '用户')->display(function ($id) {
//                return User::find($id)->name;
//            })->sortable();
            $grid->column('competition_id', '比赛')->display(function ($id) {
                return Competition::find($id)->title;
            })->sortable();
            $grid->column('ip', '用户')->display(function ($ip) {
                return '<strong>'.User::find($this->user_id)->name.'</strong>'
                    . '<br>' . $ip
                    . '<br>' . $this->country . $this->province . $this->city;
            })->sortable();
            $grid->column('votes', '投票')->display(function ($str) {
                $ids = json_decode($str);
                return join('<br>', Option::find($ids)->pluck('title')->toArray());
            })->sortable();
            $grid->column('header', 'User-Agent')->display(function ($str) {
                $header = json_decode($str, true);
                return join('<br>', $header['user-agent']);
            });
            //$grid->column('body', '请求体');
            $states = [
                'on' => ['value' => 1, 'text' => '有效', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '无效', 'color' => 'danger'],
            ];
            $grid->valid('有效票')->switch($states);
            $grid->created_at('投票时间')->sortable();
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
