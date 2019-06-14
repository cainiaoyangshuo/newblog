<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BuxianTasks;
use App\BuxianGetTask;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Log;

class WishController extends BaseController
{

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
        if (!isset($type) || !isset($userId)) {
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
	    $result['status'] =  $value->status;
            $result['user_name'] = $user->user_name;
            $result['head_image'] = $user->head_image;
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

}
