<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuxianTasks extends Model
{

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


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'content', 'category','sex','age','min_age','max_age','valid_at','status','is_delete'
    ];

}
