<?php

use App\Competition;
use App\Group;
use App\Option;
use App\Schedule;
use App\VoteLog;
use Carbon\Carbon;
use Zhuzhichao\IpLocationZh\Ip;

function language()
{
    App::setLocale(session('locale', 'zh-CN'));
    return App::getLocale();
}

function removeHttp($url)
{
    return str_replace_first('http://', '//', $url);
}

function complink($date, $default)
{
    $today = Carbon::createFromFormat('Y-m-d', $date);
    $cal = Schedule::where('year', $today->year)->where('month', $today->month)->where('day', $today->day)->first();
    if ($cal and $cal->visible) {
        $comp = Competition::find($cal->competition_id);
        return '<a href="'.route('after', ['id' => $comp->id]).'">'.$default.'</a>';
    }
    return $default;
}

function cal($year, $month, $day, $compId = 0)
{
    $today = \Carbon\Carbon::today();
    if ($today->month != $month) $classes[] = 'gray';
    $cal = \App\Schedule::where('year', $year)->where('month', $month)->where('day', $day)->first();
    if ($cal and $cal->visible) {
        $url = route('after', ['id' => $cal->competition_id]);
        if ($cal->competition_id == $compId) {
            return '<a href="' . $url . '" class="ui pink circular label">' . $day . '</a>';
        } else {
            return '<a href="' . $url . '">' . $day . '</a>';
        }
    } else if ($today->month == $month) {
        return '<span style="color: black;">' . $day . '</span>';
    } else {
        return '<span style="color: grey;">' . $day . '</span>';
    }
}

function calculate($id, $valid = 1)
{
    $competition = Competition::find($id);
    $votelogs = VoteLog::where('competition_id', $id)->get();

    $groups = Group::where('competition_id', $id)->get();
    $groupIds = $groups->pluck('id');
    $options = Option::whereIn('group_id', $groupIds)->get();

    $groupMap = [];
    foreach ($groups as $group) {
        $group->voted = 0;
        $group->valid = 0;
        $groupMap[$group->id] = &$group;
    }
    $map = [];
    foreach ($options as $option) {
        $option->voted = 0;
        $option->valid = 0;
        $map[$option->id] = $option;
    }
    $count = 0;

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
        $votes = array_unique($votes);
        if ($votelog->created_at->lt($competition->start_at) || $votelog->created_at->gt($competition->end_at)) {
            $votelog->valid = false;
        }
        $allows = [];
        foreach ($groups as $group) {
            $allows[$group->id] = ['allow' => $group->allow, 'count' => 0];
        }
        foreach ($votes as $vote) {
            $option = null;
            if ($map[$vote]->id === $vote) {
                $option = $map[$vote];
            } else {
                foreach ($map as $oid => $op) {
                    if ($op->id == $vote) {
                        $option = $op;
                        break;
                    }
                }
            }
            if (!$option) $option = Option::find($vote)->get();
            $groupId = $option->group_id;
            $groupMap[$groupId]->voted++;
            $allow = &$allows[$groupId];
            if ($allow['count']++ >= $allow['allow']) {
                $votelog->valid = false;
                continue;
            }
            $option->voted++;
            $option->valid += $votelog->valid ? 1 : $valid;
            $count += $votelog->valid ? 1 : $valid;
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
    foreach ($groupMap as $gid => $group) {
        $group->save();
    }
    $total = count($votelogs);
    $competition->voted = $total;
    $competition->valid = $count;
    $competition->save();

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
    return true;
}

function success($data = [], $info = 'success')
{
    return response()->json([
        'code' => 0,
        'info' => $info,
        'data' => $data
    ]);
}

function error($code = -1, $info = 'error', $data = [])
{
    return response()->json([
        'code' => $code,
        'info' => $info,
        'data' => $data
    ]);
}
