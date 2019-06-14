<?php

namespace App\Http\Controllers;

use App\Buser;
use Illuminate\Http\Request;

class BuserController extends Controller
{
    /**
     * Redirect to user information page.
     *
     * @return redirect
     */
    public function index(Request $request)
    {
	$userId = $request->get('userId');
        if (!isset($userId)) {
            return false;
        }

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
	return view('buxian.detail')>with(['list' => $res]);
    }
}
