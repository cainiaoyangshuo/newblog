<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Monolog\Logger;
use App\Tools\Curl;
use App\Mail\WeatherForecast;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static $goodDay = ['晴', '多云', ];
    public static $badDay = ['小雨', '中雨', '大雨'];

    public $weekMap = ['周一', '周二', '周三', '周四', '周五', '周六', '周日'];
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $key = config('third.gaode.key');
        $this->getWeatherInfo(1,110105, $key);
    }

    public function getWeatherInfo($date, $city, $key, $extensions = 'all')
    {

        $url = config('third.gaode.url');

        $params = ['city' => $city, 'key' => $key, 'extensions' => $extensions];
        $url = $url .'?'. http_build_query($params);

        $res = Curl::get($url);

        if (!empty($res)) {
            $res = json_decode($res, true);
            $forecasts = $res['forecasts'];
            $casts = $forecasts[0]['casts'];
            foreach ($casts as $key => $cast) {
                $casts[$key]['week'] = $this->weekMap[$cast['week']-1];

            }

            $targetAddress = '3546544379@qq.com';
            Mail::to($targetAddress)->send(new WeatherForecast($casts));
        } else {
            echo 'something wrong!';
            exit;
        }

        //Mail::send('commands.weather',['name' => config('mail.from.name')],function($message){
        //    $targetAddress = '3546544379@qq.com';
        //    $to = $targetAddress;
        //    $message->to($to);
        //});
    }

}
