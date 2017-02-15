<?php

namespace App\Admin\Controllers;

use App\Competition;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CompetitionController extends Controller
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

            $content->header('比赛');
            $content->description('每天的比赛列表');

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

            $content->header('修改比赛');
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

            $content->header('创建比赛');
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
        return Admin::grid(Competition::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('title', '比赛名称')->sortable();
            $grid->groups('包含分组')->value(function ($characters) {
                $characters = array_map(function ($character) {
                    return '<span class="label label-default">' . $character['title'] . '</span>';
                }, $characters);
                return join(' ', $characters);
            });
            $grid->column('voted', '投票')->display(function () {
                return $this->valid . '/' . $this->voted;
            })->sortable();
            $grid->description('描述');
            $grid->start_at('比赛时间')->display(function () {
                return $this->start_at . ' -- ' . $this->end_at;
            })->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Competition::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', '比赛名称')->rules('required');
            $form->datetimeRange('start_at', 'end_at', '比赛时间');
            $form->display('voted', '已投票')->default(0);
            $form->display('valid', '有效票')->default(0);
            $form->textarea('description', '比赛描述');
            $form->json('info', '其他信息');

        });
    }
}
