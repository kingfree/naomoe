<?php

namespace App\Admin\Controllers;

use App\Competition;
use App\Schedule;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ScheduleController extends Controller
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

            $content->header('赛程');
            $content->description('赛程表关联');

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

            $content->header('创建赛程');
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

            $content->header('编辑赛程');
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
        return Admin::grid(Schedule::class, function (Grid $grid) {
            $grid->year('年');
            $grid->month('年');
            $grid->day('年');
            $grid->competition_id('比赛')->display(function ($id) {
                return Competition::find($id)->title;
            });
            $grid->visible('可见')->switch();
            $grid->info('额外信息');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Schedule::class, function (Form $form) {
            $today = Carbon::today();
            $form->number('year', '年')->default($today->year);
            $form->number('month', '月')->default($today->month);
            $form->number('day', '日')->default($today->day);
            $form->select('competition_id', '关联比赛')->options(function ($id) {
                $competition = Competition::find($id);
                if ($competition) {
                    return [$competition->id => $competition->title];
                }
            })->ajax('/admin/api/competitions');
            $form->switch('visible', '可见')->default(true);
            $form->json('info', '额外信息');
        });
    }
}
