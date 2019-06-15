<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wish extends Model
{

    static public function getWishList($userId,$type)
    {
	    if(empty($userId)&&$type !== 1 && $type !== 2){
		    return false;
	    }

	    $table = $type == 1 ? 'buxian_tasks' : 'buxian_get_task';

	    $result = DB::table($table)->where('user_id',trim($userId))->where('is_delete', 0)->get()->toArray();

	    return $result;
    }

}
