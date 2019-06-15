<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BuxianTasks;
use App\BuxianGetTask;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use PDO;

class WishController extends BaseController
{
	

    /**
     * 任务列表
     * return
     *
     */
    public function index(Request $request)
    {
	$user = Auth::user();    
	//1已发布 2已认领
        $type = $request->get('type');

	$user = Auth::user();
    	$userId = Auth::id();
        $list = Wish::getWishList($userId,$type);
        $results = [];
        foreach ($list as $value) {
        //if($type == 2){
        //        //$value=DB::table('buxian_tasks')->where('id',trim($value->task_id))->first();
        //    }
            //$user = DB::table('buxian_user')->where('id', $value->user_id)->first();
            $result['id'] = $value->id;
            $result['title'] = $value->title;
            $result['content'] = $value->content;
            $result['time'] = $value->created_at;
            $result['user_id'] = $value->user_id;
            $result['status'] =  $value->status;
            $result['user_name'] = $user->name;
            $result['head_image'] = $user->avatar;
        if (!isset($type)) {
            return false;
	}
        $list = Wish::getWishList($userId,$type);
        $results = [];
        foreach ($list as $value) {
	    if($type == 2){
                $value=DB::table('buxian_tasks')->where('id',trim($value->task_id))->first();
            }
	    $result['id'] = $value->id;
            $result['title'] = $value->title;
            $result['content'] = $value->content;
            $result['time'] = $value->created_at;
	    $result['user_id'] = $value->user_id;
	    $result['status'] =  $value->status;
            $result['user_name'] = $user['name'];
            $result['head_image'] = $user['avatar'];
            $results[] = $result;
        }
        
        return json_encode($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id task id
     * @return \Illuminate\Http\Response
     */
    public function agree($id)
    {
        error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'参数：'.$id)));
        $dbStart = false;
        try{
            $task = BuxianTasks::findOrFail($id);
            if(empty($task)){
                return $this->returnJsonData('',1005,'任务不存在');
            }
            DB::beginTransaction();
            $dbStart = true;
            $task->update(array(
                'status'=>2,
                'updated_at'=>time(),
            ));
            error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'参数：'.$id)));
            $insertResult =  BuxianGetTask::create(array(
                'task_id' => $id,
                'user_id' => 2,
            ));
            error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'参数：'.$id)));
            if(!$insertResult){
                throw new \Exception('认领失败');
            }
            error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'参数：'.$id)));
            DB::commit();
            return $this->returnJsonData('',0,'');
        }catch(\Exception $e){
            error_log(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'参数：'.$id,$e->getMessage())));
            $dbStart && DB::rollback();
            return $this->returnJsonData('',1006,'认领失败');
        }
    }

    public function detail(Request $request){
	$user = Auth::user();    
	DB::setFetchMode(PDO::FETCH_ASSOC);
	$user = DB::table('users')->where('id', 600032)->get()->toArray();    
	$taskId = 1; 
		//$request->get('taskId');
        
	if (!isset($taskId)) {
            return false;
	}
	$value=DB:table('buxian_tasks')->where('id',trim($taskId))->where('user_id',trim($user['id']))->first();
	//如果为空，则为认领人点击
	if(empty($value)){
	   $get_userinfo=DB::table('users')->where('id', $value->user_id)->get()->toArray();
	   $user = $get_userInfo;
	}else{
	   //邀请人点击
	   $info = DB::table('buxian_get_task')->where('task_id',trim($taskId))->first();
	   $get_userinfo=DB::table('users')->where('id', $info->user_id)->get()->toArray();
	}
	//get指神秘人信息	
	$result['head_image'] = $user['atavar'];
	$result['get_head_image'] = $get_userinfo['atavar'];
	$result['status'] = $value->status;
	$result['user_name'] = $user['name'];
	$result['get_user_name'] = $get_userInfo['name'];
	$result['created_at'] =  $value->created_at;
	$result['get_age'] = $get_userInfo['age'];
	$result['get_cons'] = $get_userInfo['constellation'];
	$result['get_wechat'] = $get_userInfo['WeChat'];
 	$result['title'] = $value->title;
 	$result['content'] =  $value->content;
	return json_encode($result);
    }


}
