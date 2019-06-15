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
	        $result = DB::table('buxian_get_task')
                ->join('buxian_tasks', 'buxian_get_task.task_id','=', 'buxian_tasks.id')
	            ->where('buxian_tasks.user_id', $userId)
                ->orderByDesc('buxian_get_task.created_at')
                ->get()
                ->toArray();
        }

	    return $result;
    }

}
