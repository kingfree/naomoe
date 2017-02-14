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
            $grid->name('角色')->display(function () {
                return join('<br>', array_merge([$this->name], array_values($this->names)));
            })->sortable();
            $grid->work('作品')->display(function () {
                return join('<br>', array_merge([$this->work], array_values($this->works)));
            })->sortable();
            $grid->column('info->source', '来源')->display(function () {
                $roles = $this->info['source'] ?? [];
                $roles = array_map(function ($role) {
                    return "<span class='label label-success'>{$role}</span>";
                }, $roles);
                return join('<br>', $roles);
            })->sortable();
            $grid->description('描述');

            $grid->updated_at('修改时间')->sortable();

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

            $form->text('name', '角色名')->rules('required');
            $form->text('work', '作品名')->rules('required');

            $form->embeds('names', '其他角色名', function ($form) {
                $form->text('ja', '日文 ');
                $form->text('en', '英文');
            });

            $form->embeds('works', '其他作品名', function ($form) {
                $form->text('ja', '日文');
                $form->text('en', '英文');
            });

            $form->embeds('info', '额外信息', function ($form) {
                $form->checkbox('source', '来源')->options(Character::SOURCES)->default('动画');
            });
            $form->textarea('description', '描述');
            //$form->json('info', '额外信息');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '修改时间');

//            $form->saving(function (Form $form) {
//                $form->info = json_decode($form->info);
//            });

        });
    }
}
