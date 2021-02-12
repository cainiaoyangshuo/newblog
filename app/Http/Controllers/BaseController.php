<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;

class BaseController extends Controller
{

    public function returnJsonData($data,$errorCode=0,$errorMsg=''){
        return json_encode(array(
            'data' => $data,
            'errorCode' => $errorCode,
            'errorMsg' => $errorMsg,
        ));
    }

}