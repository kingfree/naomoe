<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Http\Controllers\Controller;
use App\Pool;
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
                    'title'   => '导入Excel',
                    'message' => '导入了' . $number . '个角色！',
                ]);
                session()->flash('success', '导入了' . $number . '个角色！');
            }
        }
        return redirect()->route('characters.index')->with(compact('success'));
    }
}