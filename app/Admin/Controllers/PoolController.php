<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\ImportExcel;
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
            $grid->tools(function ($tools) {
                $tools->append(new ImportExcel());
            });

            $grid->id('ID')->sortable();
            $grid->title('标题')->sortable();
            $grid->characters('角色列表')->value(function ($characters) {
                $characters = array_map(function ($character) {
                    return '<span class="label label-default">' . $character['name'] . '</span>';
                }, $characters);
                return join(' ', $characters);
            });
            $grid->description('描述')->sortable();
//            $grid->created_by('创建人')->value(function ($user) {
//                return $user ? '@' . $user['name'] : '';
//            });
            $grid->created_at('创建时间')->sortable();
            $grid->updated_at('修改时间')->sortable();


            $grid->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $query->where('title', 'like', "%{$this->input}%")
                        ->orWhere('description', 'like', "%{$this->input}%");
                }, '搜索');
            });

            $grid->actions(function ($actions) {
                $actions->prepend('<a href="' . route('generation', ['id' => $actions->getKey()]) . '" title="生成分组"><i class="fa fa-paper-plane"></i></a>');
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
        return Admin::form(Pool::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '标题');
            $form->multipleSelect('characters', '角色')->options(function ($ids) {
                $script = <<<JS
$('.characters').select2().val({$this->characters->pluck('id')}).trigger("change");
JS;
                Admin::script($script);
                $charas = Character::find($ids);
                if (!$charas) {
                    return $this->characters->pluck('text', 'id');
                } else {
                    return $charas->pluck('text', 'id');
                }
            })->ajax('/admin/api/characters');
            $form->textarea('description', '描述');
        });
    }
}
