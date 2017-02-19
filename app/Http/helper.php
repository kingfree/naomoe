<?php

function language()
{
    App::setLocale(session('locale', 'zh-CN'));
    return App::getLocale();
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