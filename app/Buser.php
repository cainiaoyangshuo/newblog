<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buser extends Model
{
    const TABLE = 'buxian_user';

    static public function getUserInfo($userId)
    {
	$userId = trim($userId);
	if (!empty($userId)) {
            $result = DB::table(self::TABLE)->where('id',$userId)->first();
	    return $result;
        }

        return false;
    }

}
