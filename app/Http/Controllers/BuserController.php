<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class BuserController extends Controller
{
    /**
     * Redirect to user information page.
     *
     * @return redirect
     */
    public function index()
    {
	$userId = 2;
	$result =  Buser::getUserInfo($userId);
	if(empty($result)){
	   return false;
	}
	
	$res['userName'] = $result->user_name;
	$res['imageUrl'] = $result->head_image;
	$res['WeChat'] = '';
	$res['constellation'] = '';
	$res['oftenAppear'] = '';
	$res['age'] = '';
	$res['id'] = $userId;
	return view()>with($res);
    }
}
