<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Competition;
use App\Group;
use App\Http\Controllers\Controller;
use App\Option;
use App\Pool;
use App\VoteLog;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Ip;

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

    public function groups(Request $request)
    {
        $q = $request->get('q');

        return Group::where('title', 'like', "%$q%")
            ->paginate(null);
    }

    public function competitions(Request $request)
    {
        $q = $request->get('q');

        return Competition::where('title', 'like', "%$q%")
            ->paginate(null);
    }

    public function options(Request $request)
    {
        $q = $request->get('q');

        return Option::where('title', 'like', "%$q%")
            ->paginate(null);
    }

    public function calculate($id)
    {
        $competition = Competition::find($id);
        $votelogs = VoteLog::where('competition_id', $id)->get();

        $groups = Group::where('competition_id', $id)->get();
        $groupIds = $groups->pluck('id');
        $options = Option::whereIn('group_id', $groupIds)->get();

        $groupMap = [];
        foreach ($groups as $group) {
            $groupMap[$group->id] = $group;
        }
        $map = [];
        foreach ($options as $option) {
            $option->voted = 0;
            $option->valid = 0;
            $map[$option->id] = $option;
        }

        foreach ($votelogs as $votelog) {
            if (!$votelog->votes) {
                $body = $votelog->body();
                if ($body['votes']) {
                    $votes = $body['votes'];
                    $votelog->votes = json_encode($votes);
                } else {
                    $votes = [];
                }
            } else {
                $votes = json_decode($votelog->votes);
            }
            if ($votelog->created_at->lt($competition->start_at) || $votelog->created_at->gt($competition->end_at)) {
                $votelog->valid = false;
            }
            $allows = [];
            foreach ($groups as $group) {
                $allows[$group->id] = ['allow' => $group->allow, 'count' => 0];
            }
            foreach ($votes as $vote) {
                $allow = &$allows[$map[$vote]->group_id];
                if ($allow['count']++ >= $allow['allow']) {
                    $votelog->valid = false;
                    continue;
                }
                $map[$vote]->voted++;
                $map[$vote]->valid += $votelog->valid ? 1 : 0;
            }
            $location = Ip::find($votelog->ip);
            $votelog->country = $location[0];
            $votelog->province = $location[1];
            $votelog->city = $location[2];
            $votelog->save();
        }

        foreach ($map as $oid => $option) {
            $option->save();
        }

        foreach ($groups as $group) {
            $score = 9999999;
            foreach ($group->rank as $index => $option) {
                if ($index + 1 <= $group->win) {
                    $option->winner = 2;
                    $score = $option->valid;
                } else if ($option->valid >= $score) {
                    $option->winner = 1;
                } else {
                    $option->winner = 0;
                }
                $option->save();
            }
        }
        return redirect()->back();
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
                            'en' => array_get($val, '罗马音', '')
                        ];
                        $chara->work = $val['出处'];
                        $chara->works = [
                            'ja' => array_get($val, '作品日文名', ''),
                            'en' => ''
                        ];
                        $chara->info = [
                            'source' => [array_get($val, '来源', '动画')],
                            '编号' => array_get($val, '编号', ''),
                            '有图' => array_get($val, '是否有图', '')
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