<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SaveToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        while (1) {

            // 在队列最左侧取出一个值 并判断是否存在
            $user = Redis::lPop('miaosha');

            if (!$user || $user == 'nil') {
                sleep(2);
                continue;
            }


            // 切割 出id 和 time
            $userInfo = explode('%', $user);
            //var_dump($userInfo);exit;
            $userArr = ['from_user_id' => $userInfo[0], 'created_at' => $userInfo[1]];

            $res = DB::table('buxian_messages')->insert($userArr);

            // 插入失败回滚
            if (!$res) {
                Redis::rPush('miaosha', $user);
            }

            sleep(2);
        }
    }
}
