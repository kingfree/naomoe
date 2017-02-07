<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Pool;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PoolController extends Controller
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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Pool::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('标题');
            $grid->characters('角色列表')->value(function ($characters) {
                $characters = array_map(function ($character) {
                    return $character['name'];
                }, $characters);
                return join('&nbsp;', $characters);
            });
            $grid->description('描述');
            $grid->created_by('创建人')->value(function ($user) {
                return $user ? '@' . $user['name'] : '';
            });
            $grid->created_at('创建时间');
            $grid->updated_at('修改时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Pool::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '标题');
            // TODO: 多选列表无法载入已保存的信息
            $form->multipleSelect('characters', '角色列表')->options(function ($ids) {
                return ($this->characters->pluck('text', 'id'));
            })->ajax('/admin/api/characters');
            $form->textarea('description', '描述');
        });
    }
}
