<?php
/**
 * @date 2019/8/2
 */

namespace App\Http\Controllers;

use App\Tools\Curl;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Request;

class TestSocketController extends BaseController
{
    public function push(Request $request)
    {
        $params = $request['input'];

        if (empty($params)) {
            throw new \Exception('参数不能为空');
        }

        $url = 'http://127.0.0.1:9502';
        $res = Curl::post($url, $params);

        Logger::info('request result : ' . $res);
    }
}