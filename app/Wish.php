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

	    //$table = $type == 1 ? 'buxian_tasks' : 'buxian_get_task';

	    if ($type == 1) {
            $result = DB::table('buxian_tasks')->where('user_id',trim($userId))->where('is_delete', 0)->orderByDesc('created_at')->get()->toArray();
        } else {
	        //$result = DB::table('buxian_tasks')
             //  ->join('buxian_get_task', 'buxian_get_task.task_id','=', 'buxian_tasks.id')
             //   ->where('buxian_get_task.user_id', $userId)
             //  ->orderByDesc('buxian_get_task.created_at')
             //  ->get()
             //  ->toArray();
            $result = DB::select("SELECT t.* FROM buxian_get_task AS gt INNER JOIN buxian_tasks AS t ON  gt.task_id = t.id WHERE gt.user_id = {$userId} ORDER BY t.id  DESC ;");
        }

	    return $result;
    }

}
