<?php

namespace App\Console\Commands;

use App\Competition;
use App\Option;
use App\User;
use App\VoteLog;
use Illuminate\Console\Command;
use Zhuzhichao\IpLocationZh\Ip;

class Vote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vote:do {comp} {yes} {no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vote It';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getRandIp()
    {
        for ($i = 1; $i < 100; $i++) {
            $ip = long2ip(random_int(1, 255 * 255 * 255 * 255 - 1));
            $locatian = Ip::find($ip);
            if (!empty($locatian[4])) break;
        }
        return $ip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $yes = array_map(function ($e) {
            return intval($e);
        }, explode(',', $this->argument('yes')));
        $no = array_map(function ($e) {
            return intval($e);
        }, explode(',', $this->argument('no')));
        $compId = $this->argument('comp');
        $comp = Competition::find($compId);

        for ($i = 0; $i < 100; $i++) {
            $ip = $this->getRandIp();
            $record = VoteLog::where('ip', $ip)->where('competition_id', $compId)->first();
            if (!$record) break;
        }
        $user = User::firstOrCreate([
            'name' => $ip
        ]);
        if ($user->password) {
            echo $ip, $user->id;
            return false;
        }

        $votes = [];
        $votes[] = $yes;
        foreach ($comp->groups as $group) {
            $allow = $group->allow;
            $tou = random_int(2, $allow - 1);
            $options = $group->options->pluck('id');
            $arr = $options->toArray();
            $rands = array_rand($arr, $tou);
            foreach ($rands as $index) {
                $votes[] = $arr[$index];
            }
        }
        $votes = array_values(array_diff(array_unique(array_flatten($votes)), $no));
        $body = [
            'votes' => $votes,
            'competition_id' => $compId,
            'comment' => null
        ];

        $record = VoteLog::inRandomOrder()->first();
        $header = $record->headers();
        if (array_key_exists('cf-ray', $header)) {
            unset($header['cf-ray']);
        }
        $header['x-forwarded-for'] = [$ip];
        $header['cf-connecting-ip'] = [$ip];
        $log = new VoteLog;
        $log->competition_id = $compId;
        $log->user_id = $user->id;
        $log->header = $header;
        $log->body = $body;
        $log->ip = $ip;
        $log->comment = $body['comment'];
        $log->votes = $votes;
        $log->save();
        dump($log);

        return true;

    }
}