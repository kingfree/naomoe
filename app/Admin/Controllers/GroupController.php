<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Competition;
use App\Group;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class GroupController extends Controller
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

            $content->header('分组');
            $content->description('可以限定一个分组内最多投票的数量');

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

            $content->header('编辑分组');
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

            $content->header('创建分组');
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
        return Admin::grid(Group::class, function (Grid $grid) {
            $grid->model()->orderBy('updated_at', 'desc');

            $grid->id('ID')->sortable();
            $grid->column('info', '头像')->value(function ($info) {
                return json_decode($info, true)['avatar'];
            })->image();
            $grid->column('title', '分组')->sortable();
            $grid->column('competition_id', '所属比赛')->display(function ($id) {
                if (!$id) return '';
                return Competition::find($id)->text;
            });
            $grid->options('选项列表')->value(function ($options) {
                $options = array_map(function ($character) {
                    return '<span class="label label-default">' . $character['title'] . '</span>';
                }, $options);
                return join(' ', $options);
            });
            $grid->win('晋级');
            $grid->allow('可投');
            $grid->updated_at('修改时间')->sortable();
            $grid->column('选项数量')->value(function () {
                return count($this->options);
            });

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('title', 'like', "%{$this->input}%")
                        ->orWhere('id', $this->input);
                }, '搜索');
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
        return Admin::form(Group::class, function (Form $form) {
            $form->text('title', '分组名');
            $form->number('order', '顺序');
            $form->select('competition_id', '关联比赛')->options(function ($id) {
                $competition = Competition::find($id);
                if ($competition) {
                    return [$competition->id => $competition->title];
                }
            })->ajax('/admin/api/competitions');
            $form->json('info', '其他信息');
            $form->number('win', '晋级数')->default(1);
            $form->number('allow', '允许投票数')->default(1);
            $form->hasMany('options', '选项', function (Form\NestedForm $nest) {
                $nest->text('title', '选项');
                $nest->select('character_id', '关联角色')
                    ->options(function ($id) {
                        $chara = Character::find($id);
                        if ($chara) {
                            return [$chara->id => $chara->text];
                        }
                    })->ajax('/admin/api/characters');
            });

        });
    }
}
