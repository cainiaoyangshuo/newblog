<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    const TABLE = 'buxian_user';

    static public function getUserInfo($userId)
    {
	$userId = trim($userId);
	if (!empty($userId)) {
            $result = DB::table(self::TABLE)->where('id',$userId)->get()->toArray();
	    /*res['userName'] = $result->user_name;
	    $res['imageUrl'] = $result->head_image;
	    $res['WeChat'] = $result->weChat;
	    $res['constellation'] = '';
	    $res['oftenAppear'] = '';
	    $res['age'] = '';
	     */
	    return $result[0];
        }

        return false;
    }

}
