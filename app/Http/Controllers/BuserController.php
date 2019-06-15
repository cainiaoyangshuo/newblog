<?php

namespace App\Http\Controllers;

use App\Buser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuserController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $res['name'] = $user['name'];
        $res['avatar'] = $user['avatar'];
        $res['WeChat'] = $user['WeChat'];
        $res['constellation'] = $user['constellation'];
        $res['oftenAppear'] = $user['oftenAppear'];
        $res['age'] = $user['age'];
        $res['id'] = $user['id'];
        $list = $res;

        return view('buxian.editinfo')->with(['list' => $list]);
    }

    public function userIndex(){    
	$user = Auth::user();
        $res['name'] = $user['name'];
	$res['avatar'] = $user['avatar'];

	$list = $res;
	return json_encode($list);

    }
}
