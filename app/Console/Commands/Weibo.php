<?php

namespace App\Console\Commands;

use App\Competition;
use App\VoteLog;
use HttpException;
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

        VoteLog::where('created_at', '>=', '2017-03-07')->where('valid', '>', 0)->chunk(function ($votes) use (&$users) {
            foreach ($votes as $vote) {
                $user = $vote->user;
                if ($user->user_id) {
                    if (!array_key_exists($user->user_id, $users)) {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://api.duoshuo.com/users/profile.json?user_id=" . $user->user_id,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);

                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            $res = json_decode($response, true);
                            $users[$user->user_id] = $res['response']['connected_services']['weibo'];
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
