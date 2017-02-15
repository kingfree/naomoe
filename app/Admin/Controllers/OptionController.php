<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Group;
use App\Option;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class OptionController extends Controller
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

            $content->header('投票项');
            $content->description('可以投票的选项列表');

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

            $content->header('编辑投票项');
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

            $content->header('创建投票项');
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
        return Admin::grid(Option::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '投票项')->sortable();
            $grid->character_id('关联角色')->value(function ($id) {
                return Character::find($id)->text;
            })->sortable();
            $grid->group_id('关联分组')->value(function ($id) {
                return Group::find($id)->title;
            })->sortable();
            $grid->voted('已投')->sortable();
            $grid->valid('有效')->sortable();
            $grid->description('描述');

            $grid->created_at('创建时间');
            $grid->updated_at('修改时间');

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->like('name', '选项');
                $filter->is('group_id', '分组')->select(Group::all()->pluck('title', 'id'));

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
        return Admin::form(Option::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '投票项标题');

            $form->select('character_id', '关联角色')->options(function ($id) {
                $chara = Character::find($id);
                if ($chara) {
                    return [$chara->id => $chara->text];
                }
            })->ajax('/admin/api/characters');
            $form->select('group_id', '关联分组')->options(function ($id) {
                $group = Group::find($id);
                if ($group) {
                    return [$group->id => $group->title];
                }
            })->ajax('/admin/api/groups');

            $form->number('voted', '已投票');
            $form->number('valid', ' 有效票');

            $form->textarea('description', '描述');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '修改时间');
        });
    }
}
