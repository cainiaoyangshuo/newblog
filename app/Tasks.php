<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
    //
    const TABLE = 'buxian_tasks';

    const SEX_NO = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    public static $sexs = array(
        self::SEX_NO => '不限制',
        self::SEX_MALE => '男',
        self::SEX_FEMALE => '女',
    );

    const FENLEI_ZHUOYOU = 1;
    const FENLEI_DIBIAO = 2;
    const FENLEI_GUANGJIE = 3;
    const FENLEI_WANGYOU = 4;
    const FENLEI_DIANYING = 5;

    public static $categorys = array(
        self::FENLEI_ZHUOYOU => '桌游',
        self::FENLEI_DIBIAO => '地标打卡',
        self::FENLEI_GUANGJIE => '逛街',
        self::FENLEI_WANGYOU => '线上网游',
        self::FENLEI_DIANYING => '电影',
    );

    static public function getTaskList($count = false, $makePage = false, $page = 1, $pageSize = 10)
    {
        if ($makePage) {
            //$res = DB::table(self::TABLE)->paginate();
            $page = intval($page) >= 1 ? intval($page) : 1;
            $pageSize = intval($pageSize) >= 0 ? intval($pageSize) : 10;
            $offset = ($page - 1) * $pageSize;
            $limit = $pageSize;
            $res = DB::table(self::TABLE)->offset($offset)->limit($limit)->get()->toArray();
        }

        if ($count) {
            $coun = DB::table(self::TABLE)->count();
        }

        $result['count'] = $coun ?? '';
        $result['list'] = $res ?? '';
        return $result;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'content', 'category','sex','min_age','max_age','valid_at','status'
    ];

}
