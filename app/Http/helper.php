<?php

function language()
{
    App::setLocale(session('locale', 'zh-CN'));
    return App::getLocale();
}
