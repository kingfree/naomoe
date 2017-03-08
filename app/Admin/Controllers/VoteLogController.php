<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\KanPiao;
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
use Illuminate\Support\Facades\Input;

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
            $grid->model()->orderBy('id', 'desc');

//            $grid->column('user_id', '用户')->display(function ($id) {
//                return User::find($id)->name;
//            })->sortable();
            $grid->column('competition_id', '比赛')->display(function ($id) {
                return Competition::find($id)->title;
            })->sortable();
            $grid->column('votes', '投票')->display(function ($str) {
                $ids = json_decode($str);
                $str = '<ul>';
                foreach (Option::find($ids)->pluck('title')->toArray() as $item) {
                    $str .= '<li>' . $item . '</li>';
                }
                $str .= '</ul>';
                return $str;
            })->sortable();
            $grid->column('ip', '用户')->display(function ($ip) {
                $str = '<strong>' . User::find($this->user_id)->name . '</strong>'
                    . '<br>' . $ip
                    . '<br>' . $this->country . $this->province . $this->city
                    . '<hr>' . $this->comment;
                return $str;
            })->sortable();
//            $grid->column('header', 'User-Agent')->display(function ($str) {
//                $header = json_decode($str, true);
//                return join('<br>', $header['user-agent']);
//            });
            $grid->column('header', '请求头')->display(function ($value) {
                $header = json_decode($value);
                $str = '<dl class="dl-horizontal">';
                foreach ($header as $k => $v) {
                    if (in_array($k, ['user-agent', 'accept-language', 'cf-ray', 'cf-ipcountry']))
                        $str .= '<dt>' . $k . '</dt><dd>' . (is_array($v) ? join(' ', $v) : $v) . '</dd>';
                }
                return $str . '</dl>';
            });
            //$grid->column('body', '请求体');
            $states = [
                'on' => ['value' => true, 'text' => '有效', 'color' => 'success'],
                'off' => ['value' => false, 'text' => '无效', 'color' => 'danger'],
            ];
            $grid->valid('有效票')->switch($states)->sortable();
            $grid->created_at('投票时间')->sortable();

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->add('标记为有效票', new KanPiao(1));
                    $batch->add('标记为无效票', new KanPiao(0));
                });
            });

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('header', 'like', "%{$this->input}%");
                }, '请求');
                $filter->is('competition_id', '比赛')->select(Competition::all()->pluck('title', 'id'));
                $filter->is('valid', '有效')->select(['0' => '无效', '1' => '有效']);
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
        return Admin::form(VoteLog::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->switch('valid', '可见')->default(true);
            $form->display('user_id', '用户ID');
            $form->display('ip', 'IP');
            $form->display('header', '请求头')->with(function ($value) {
                $header = json_decode($value);
                $str = '<dl class="dl-horizontal">';
                foreach ($header as $k => $v) {
                    $str .= '<dt>' . $k . '</dt><dd>' . (is_array($v) ? join(' ', $v) : $v) . '</dd>';
                }
                return $str . '</dl>';
            });
            $form->display('body', '请求体');
            $form->display('votes', '投票');
            $form->display('comment', '评论');
            $form->display('created_at', 'Created At');
        });
    }

    public function kanpiao()
    {
        foreach (VoteLog::find(Input::get('ids')) as $post) {
            $post->valid = !!Input::get('action');
            $post->save();
        }
    }

}
