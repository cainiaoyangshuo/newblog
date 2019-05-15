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

        $this->config = config('third');
    }

    public $config;
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

        $key = $this->config['gaode']['key'];
        $targets = $this->config['targetAdd'];
        $cities = $this->config['cityCode'];
        $this->getWeatherInfo($targets['me'],$cities['朝阳'], $key);
    }

    public function getWeatherInfo($targetAdd, $city, $key, $extensions = 'all')
    {

        $url = $this->config['gaode']['url'];

        $params = ['city' => $city, 'key' => $key, 'extensions' => $extensions];

        $url = $url .'?'. http_build_query($params);

        $res = Curl::get($url);

        if (!empty($res)) {
            $res = json_decode($res, true);
            $forecasts = $res['forecasts'][0];      //返回体为一个数组，只有一个元素取第一个
            $casts = $forecasts['casts'];
            $today = date('Y-m-d', time());   //今天的日期突出颜色
            $toArr['city'] = $forecasts['city'];
            $toArr['rainToday'] = '';

            foreach ($casts as $key => $cast) {
                if ($today == $cast['date']) {
                    $casts[$key]['week'] = '今天';

                    if (strstr($cast['dayweather'], '雨')) {
                        $toArr['rainToday'] = '今天有雨 🌧';
                    }

                    continue;
                }
                $casts[$key]['week'] = $this->weekMap[$cast['week']-1];
            }

            $targetAddress = $targetAdd;
            Mail::to($targetAddress)->send(new WeatherForecast($casts, $toArr));
        } else {
            echo 'something wrong!';
            exit;
        }

    }

}
