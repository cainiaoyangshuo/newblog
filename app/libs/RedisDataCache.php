<?php
/**
 * @date 2019/7/8
 */
namespace App\libs;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class RedisDataCache
{

    /**
     * @param      $moduleInstance
     * @param      $function
     * @param      $params
     * @param int  $expires
     * @param bool $forceRefresh
     * @param bool $writeLock
     * @return array|bool|mixed
     */
    public function call($moduleInstance, $function, $params, $expires = 10, $forceRefresh = false, $writeLock = false)
    {

        // 定义规则生成唯一key
        $cacheKey = sprintf("DATACACHE_%s_%s_%s", get_class($moduleInstance), $function, md5(serialize($params)));

        // 先从redis读
        try {
            $cacheData = $this->get($cacheKey);
            if (!empty($cacheKey)) {
                return $cacheData;
            }

            //可以考率加上文件缓存 TODO

        } catch (\Exception $exception) {
            Log::error('RedisDataCache_GetFailed. message:'.$exception->getMessage());
        }

        // 读不到再调用传入的方法读mysql
        $result = call_user_func_array(array($moduleInstance, $function), $params);

        // 读到的为空的直接返回
        if (empty($result)) {
            return $result;
        }

        // 不为空则将结果写入缓存
        try {
            $this->set($cacheKey, $result, $expires);
        } catch (\Exception $e) {
            Log::error('RedisDataCache_SetFailed. message:'.$e->getMessage());
        }

        return $result;
    }

    /**
     * 写缓存
     * @param     $key
     * @param     $value
     * @param int $expire
     * @return bool
     */
    public function set($key, $value, $expire = 0)
    {
        if (!Redis::connection()) {
            return false;
        }

        // 将value序列化字符串
        $value = serialize($value);

        if (strlen($value) < 1) {
            return false;
        }

        if ($expire == 0) {
            $ret = Redis::set($key, $value);
        } else {
            $ret = Redis::setex($key, intval($expire), $value);
        }

        return $ret;
    }

    /**
     * 读缓存
     * @param $key
     * @return array|bool|mixed
     */
    public function get($key)
    {
        if (!Redis::connection()) {
            Log::error('redis connect error   key: ' . $key);
            return false;
        }

        if (empty($key)) {
            return false;
        }

        $func = is_array($key) ? 'mGet' : 'get';
        $ret = Redis::{$func}($key);

        if ("mGet" == $func) {
            $ret = array_map('unserialize', $ret);

            return $ret;
        }

        if ($ret === false || empty($ret)) {
            return FALSE;
        }

        // 反序列化value
        $ret = unserialize($ret);

        return $ret;

    }
}