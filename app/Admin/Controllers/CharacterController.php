<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\PutIntoPool;
use App\Character;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CharacterController extends Controller
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

            $content->header('角色列表');
            $content->description('可能参与比赛的角色和作品列表');

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

            $content->header('修改角色');
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

            $content->header('创建角色');
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
        return Admin::grid(Character::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->avatar('头像')->image();
            $grid->name('角色')->sortable();
            $grid->work('作品')->sortable();
            $grid->column('日文')->display(function () {
                if (!$this->names || !$this->works) return '';
                return $this->names->ja . '@' . $this->works->ja;
            });
            $grid->column('英文')->display(function () {
                if (!$this->names || !$this->works) return '';
                return $this->names->en . '@' . $this->works->en;
            });

            $grid->description('描述');

            $grid->column('时间')->display(function () {
                return '创建于' . $this->created_at . '<br>' . '修改于' . $this->updated_at;
            });

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('name', 'like', "%{$this->input}%")
                        ->orWhere('names', 'like', "%{$this->input}%")
                        ->orWhere('work', 'like', "%{$this->input}%")
                        ->orWhere('works', 'like', "%{$this->input}%")
                        ->orWhere('description', 'like', "%{$this->input}%");
                }, '搜索');
            });

            /* $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->add('添加进角色池', new PutIntoPool(1));
                });
            }); */
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Character::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->image('avatar', '头像');

            $form->text('name', '角色名（中文）');
            $form->text('work', '作品名（中文）');

            $form->text('names->ja', '角色名（日文）');
            $form->text('works->ja', '作品名（日文）');

            $form->text('names->en', '角色名（英文）');
            $form->text('works->en', '作品名（英文）');

            $form->textarea('description', '描述');
            $form->json('info', '额外信息');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '修改时间');
        });
    }
}
