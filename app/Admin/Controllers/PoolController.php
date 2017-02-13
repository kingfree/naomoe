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

            $content->header('角色池');
            $content->description('角色组成的临时组，用于生成分组和比赛');

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

            $content->header('编辑角色池');
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

            $content->header('创建角色池');
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
        return Admin::grid(Pool::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('标题')->sortable();
            $grid->characters('角色列表')->value(function ($characters) {
                $characters = array_map(function ($character) {
                    return $character['name'];
                }, $characters);
                return join('&nbsp;', $characters);
            });
            $grid->description('描述')->sortable();
//            $grid->created_by('创建人')->value(function ($user) {
//                return $user ? '@' . $user['name'] : '';
//            });
            $grid->created_at('创建时间')->sortable();
            $grid->updated_at('修改时间')->sortable();
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
            $form->multipleSelect('characters', '角色列表')->options(function ($ids) {
                $script = <<<JS
$('.characters').select2().val({$this->characters->pluck('id')}).trigger("change");
JS;
                Admin::script($script);
                return Character::find($ids)->merge($this->characters)->pluck('text', 'id');
            })->ajax('/admin/api/characters');
            $form->textarea('description', '描述');
        });
    }
}
