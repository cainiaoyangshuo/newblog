<?php
/**
 * @date 2019/5/20
 */

namespace App\Tools;

use EasyWeChat\Factory;

class WeChat
{
    public $conf;
    public $app;

    public function __construct()
    {
        $this->conf = config('wechat');
        $this->app = Factory::officialAccount($this->conf['test']);

    }

    public function getResponse()
    {
        return $this->app->server->serve();
    }



}