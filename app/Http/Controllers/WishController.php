<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishController extends Controller
{

    public $statusInfo = array(
        1 => '待领取',
        2 => '已领取',
        3 => '已结束',
    );

    /**
     * 任务列表
     * return
     *
     */
    public function index(Request $request)
    {
	//1已发布 2已认领
        $type = $request->get('type');
	$userId = $request->get('userId');
        if (!isset($type) || (!isset($userId)) {
            return false;
	}
        $list = Wish::getWishList($userId,$type);
        $results = [];
        foreach ($list as $value) {
	    if($type == 2){
                $value=DB::table('buxian_tasks')->where('id',trim($value->task_id))->first();
            }
            $user = DB::table('buxian_user')->where('id', $value->user_id)->first();
	    $result['id'] = $value->id;
            $result['title'] = $value->title;
            $result['content'] = $value->content;
            $result['time'] = $value->created_at;
	    $result['user_id'] = $value->user_id;
	    $result['status'] =  $this->statusInfo[$value->status];
            $result['user_name'] = $user->user_name;
            $result['head_image'] = $user->head_image;
            $results[] = $result;
        }
        return view('buxian.index')->with('list'=>$results);
    }

}
