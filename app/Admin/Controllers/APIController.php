<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Group;
use App\Http\Controllers\Controller;
use App\Option;
use App\Pool;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;

class APIController extends Controller
{

    public function characters(Request $request)
    {
        $q = $request->get('q');

        return Character::where('name', 'like', "%$q%")
            ->orWhere('names', 'like', "%$q%")
            ->orWhere('work', 'like', "%$q%")
            ->orWhere('works', 'like', "%$q%")
            ->paginate(null);
    }

    public function generateGroup($id)
    {
        $pool = Pool::find($id);
        return view('admin.tools.generate')
            ->withPool($pool);
    }

    public function doGenerateGroup()
    {
        $id = Input::get('id');
        $title = Input::get('title');
        $number = intval(Input::get('number'));
        $allow = Input::get('allow');

        $pool = Pool::find($id);
        $characters = $pool->characters()->inRandomOrder()->get();

        if ($number <= 1) {
            $charas = $characters;

            $group = new Group;
            $group->title = $title;
            $group->allow = $allow;
            $group->description = '来自角色池 ' . $pool->title;
            $group->save();
            foreach ($charas as $chara) {
                $option = new Option;
                $option->group_id = $group->id;
                $option->character_id = $chara->id;
                $option->title = $chara->text;
                $option->description = $chara->names['ja'];
                $option->save();
            }
        } else {
            $total = count($characters);
            $every = floor($total / $number);
            $chunked = array_chunk($characters->toArray(), $every);
            $index = 1;
            $groups = [];
            foreach ($chunked as $charas) {
                if ($index > $number) {
                    $n = count($charas);
                    for ($i = 0; $i < $n; $i++) {
                        $chara = $charas[$i];
                        $group = $groups[$i];
                        $option = new Option;
                        $option->group_id = $group->id;
                        $option->character_id = $chara['id'];
                        $option->title = $chara['name'] . '@' . $chara['work'];
                        $option->description = $chara['names']['ja'];
                        $option->save();
                    }
                    break;
                }
                $group = new Group;
                $group->title = $title . '-' . $index++;
                $group->allow = $allow;
                $group->description = '来自角色池 ' . $pool->title;
                $group->save();
                $groups[] = $group;
                foreach ($charas as $chara) {
                    $option = new Option;
                    $option->group_id = $group->id;
                    $option->character_id = $chara['id'];
                    $option->title = $chara['name'] . '@' . $chara['work'];
                    $option->description = $chara['names']['ja'];
                    $option->save();
                }
            }
        }
        return redirect()->route('groups.index');
    }

    public function importExport()
    {
        return view('admin.tools.import-export');
    }

    public function downloadExcel($type)
    {
        $data = Character::get()->toArray();
        return Excel::create('characters', function ($excel) use ($data) {
            $excel->sheet('naomoe', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel()
    {
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path)->get();
            $number = 0;
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $pool = new Pool;
                    $pool->title = $value->getTitle();
                    $pool->save();
                    foreach ($value as $index => $val) {
                        $chara = new Character;
                        $chara->name = $val['人物'];
                        $chara->names = [
                            'ja' => $val['日文'],
                            'en' => $val['罗马音']
                        ];
                        $chara->work = $val['出处'];
                        $chara->works = [
                            'ja' => '',
                            'en' => ''
                        ];
                        $chara->info = [
                            'source' => [$val['来源']],
                            '编号' => $val['编号'] ?? null,
                            '有图' => $val['是否有图'] ?? null
                        ];
                        $chara->description = $val['简介'];
                        $chara->save();
                        $number++;
                        $pool->characters()->save($chara);
                    }
                }
                $success = new MessageBag([
                    'title' => '导入Excel',
                    'message' => '导入了' . $number . '个角色！',
                ]);
                session()->flash('success', '导入了' . $number . '个角色！');
            }
        }
        return redirect()->route('characters.index')->with(compact('success'));
    }
}