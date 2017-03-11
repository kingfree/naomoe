<?php

namespace App\Console\Commands;

use App\Competition;
use App\VoteLog;
use HttpException;
use HttpRequest;
use Illuminate\Console\Command;

class Weibo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weibo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '微博抽奖';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = [];

        $request = new HttpRequest();
        $request->setUrl('http://api.duoshuo.com/users/profile.json');
        $request->setMethod(HTTP_METH_GET);

        VoteLog::whereDate('created_at', '>=', '2017-03-07')->chunk(function ($votes) use ($request, &$users) {
            foreach ($votes as $vote) {
                $user = $vote->user;
                if ($user->user_id) {
                    if (!array_key_exists($user->user_id, $users)) {
                        try {
                            $request->setQueryData(array(
                                'user_id' => $user->user_id
                            ));
                            $response = $request->send();

                            $res = json_decode($response->getBody(), true);
                            $users[$user->user_id] = $res['response']['connected_services']['weibo'];
                        } catch (HttpException $ex) {
                            echo $ex;
                        }
                    }
                }
            }
        });
        file_put_contents('weibo.json', json_encode($users));
        foreach ($users as $user) {
            echo $user['name'] . PHP_EOL;
        }
        return true;
    }
}
