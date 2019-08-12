<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Mockery\Exception;

class User extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

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
        $startTime = microtime(true);
        //
        $key = 'miaosha';

        if (!Redis::connection()) {
            //throw new \Exception('redis未连接');
            exit('redis未连接');
        }

        for ($i=0; $i<100; $i++) {
            $uid = rand(100000, 999999);

            // 最大值
            $max = 10;

            // 人数小于最大值，则加入队列
            if (Redis::lLen($key) < $max) {

                $res = Redis::rPush($key, $uid . '%' . microtime());
                if ($res) {
                    echo $uid . '秒杀成功！';
                } else {
                    throw new \Exception('入队失败');
                }


            } else {
                // 大于等于最大值则已结束
                echo '秒杀结束。';
            }
         }

        $endTime = microtime(true);
        echo '耗时: ' . round($endTime - $startTime, 3) . " 秒\n";
        exit;
    }
}
