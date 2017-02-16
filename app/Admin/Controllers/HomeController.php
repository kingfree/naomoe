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
use App\Vote;
use App\VoteLog;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

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
                $row->column(3, new InfoBox('投票', 'file ', 'teal', '/admin/votes', Vote::count()));
            });

            $content->row(function (Row $row) {
                if (1) return;

                $row->column(6, function (Column $column) {

                    $tab = new Tab();

                    $pie = new Pie([
                        ['Stracke Ltd', 450], ['Halvorson PLC', 650], ['Dicki-Braun', 250], ['Russel-Blanda', 300],
                        ['Emmerich-O\'Keefe', 400], ['Bauch Inc', 200], ['Leannon and Sons', 250], ['Gibson LLC', 250],
                    ]);

                    $tab->add('Pie', $pie);
                    $tab->add('Table', new Table());
                    $tab->add('Text', 'blablablabla....');

                    $tab->dropDown([['Orders', '/admin/orders'], ['administrators', '/admin/administrators']]);
                    $tab->title('Tabs');

                    $column->append($tab);

                    $collapse = new Collapse();

                    $bar = new Bar(
                        ["January", "February", "March", "April", "May", "June", "July"],
                        [
                            ['First', [40, 56, 67, 23, 10, 45, 78]],
                            ['Second', [93, 23, 12, 23, 75, 21, 88]],
                            ['Third', [33, 82, 34, 56, 87, 12, 56]],
                            ['Forth', [34, 25, 67, 12, 48, 91, 16]],
                        ]
                    );
                    $collapse->add('Bar', $bar);
                    $collapse->add('Orders', new Table());
                    $column->append($collapse);

                    $doughnut = new Doughnut([
                        ['Chrome', 700],
                        ['IE', 500],
                        ['FireFox', 400],
                        ['Safari', 600],
                        ['Opera', 300],
                        ['Navigator', 100],
                    ]);
                    $column->append((new Box('Doughnut', $doughnut))->removable()->collapsable()->style('info'));
                });

                $row->column(6, function (Column $column) {

                    $column->append(new Box('Radar', new Radar()));

                    $polarArea = new PolarArea([
                        ['Red', 300],
                        ['Blue', 450],
                        ['Green', 700],
                        ['Yellow', 280],
                        ['Black', 425],
                        ['Gray', 1000],
                    ]);
                    $column->append((new Box('Polar Area', $polarArea))->removable()->collapsable());

                    $column->append((new Box('Line', new Line()))->removable()->collapsable()->style('danger'));
                });

            });

        });
    }
}
