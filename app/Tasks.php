<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
    //
    const TABLE = 'buxian_tasks';

    static public function getTaskList($count = false, $makePage = false, $page = 1, $pageSize = 10)
    {
        if ($makePage) {
            //$res = DB::table(self::TABLE)->paginate();
            $page = intval($page) >= 1 ? intval($page) : 1;
            $pageSize = intval($pageSize) >= 0 ? intval($pageSize) : 10;
            $offset = ($page - 1) * $pageSize;
            $limit = $pageSize;
            $res = DB::table(self::TABLE)->offset($offset)->limit($limit)->get();
            return $res;
        }

        if ($count) {
            $res['count'] = DB::table(self::TABLE)->count();
            $res['list'] = DB::table(self::TABLE)->get();
            return $res;
        }

        return false;
    }
    

}
