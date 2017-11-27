<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Competition;
use App\Group;
use App\Http\Controllers\Controller;
use App\Option;
use App\Page;
use App\Pool;
use App\User;
use App\VoteLog;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('闹萌');
            $content->description('后台');

            $content->row(function ($row) {
                $row->column(3, new InfoBox('注册用户', 'user ', 'aqua', '/admin/users', User::count()));
                $row->column(3, new InfoBox('角色', 'user-md ', 'green', '/admin/characters', Character::count()));
                $row->column(3, new InfoBox('分组', 'users ', 'yellow', '/admin/groups', Group::count()));
                $row->column(3, new InfoBox('比赛', 'compass ', 'red', '/admin/competitions', Competition::count()));
            });

            $content->row(function ($row) {
                $row->column(3, new InfoBox('投票项', 'check-square-o', 'fuchsia', '/admin/options', Option::count()));
                $row->column(3, new InfoBox('角色池', 'database', 'purple', '/admin/pools', Pool::count()));
                $row->column(3, new InfoBox('投票记录', 'list', 'maroon', '/admin/votelogs', VoteLog::count()));
                $row->column(3, new InfoBox('页面', 'file ', 'teal', '/admin/pages', Page::count()));
            });

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });
            });
        });
    }
}
