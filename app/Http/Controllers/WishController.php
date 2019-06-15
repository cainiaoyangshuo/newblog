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
use App\User;
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

        $user = Auth::user();
        $userId = Auth::id();
        $list = Wish::getWishList($userId,$type);
        $results = [];

        foreach ($list as $value) {

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
     * @param  int $id task id
     * @return \Illuminate\Http\Response
     */
    public function agree($id)
    {
        error_log(implode(' | ', array(__CLASS__, __FUNCTION__, __LINE__, '参数：' . $id)));
        $dbStart = false;
        try {
            $task = BuxianTasks::findOrFail($id);
            if (empty($task)) {
                return $this->returnJsonData('', 1005, '任务不存在');
            }
            if ($task->status == 2) {
                return $this->returnJsonData('', 1008, '该任务已被领取');
            }
            if ($task->status == 3) {
                return $this->returnJsonData('', 1009, '该任务已结束');
            }
            $userId = Auth::id();
            if (empty($userId)) {
                return $this->returnJsonData('', 1007, '用户未登录');
            }
            DB::beginTransaction();
            $dbStart = true;
            $task->update(array(
                'status' => 2,
                'updated_at' => time(),
            ));
            $insertResult = BuxianGetTask::create(array(
                'task_id' => $id,
                'user_id' => $userId,
            ));
            if (!$insertResult) {
                throw new \Exception('认领失败');
            }
            DB::commit();
            return $this->returnJsonData('', 0, '');
        } catch (\Exception $e) {
            error_log(implode(' | ', array(__CLASS__, __FUNCTION__, __LINE__, '参数：' . $id, $e->getMessage())));
            $dbStart && DB::rollback();
            return $this->returnJsonData('', 1006, '认领失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id task id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $user = Auth::user()->toArray();
        $taskId = intval($id);
//        if (empty($taskId)) {
//            Log::error(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,'task id 为空')));
//            return false;
//        }
        $task = BuxianTasks::findOrFail($taskId)->toArray();
        $getTask  = BuxianGetTask::query()->where('task_id','=', $task['id'])->first()->toArray();
//        if(empty($getTask) || $task['status'] == 1) {
//            Log::error(implode(' | ', array(__CLASS__, __FUNCTION__, __LINE__, "task id 为{$id} 没有被领取")));
//            return false;
//        }
//        if(!in_array($user['id'],[$task['user_id'],$getTask['user_id']])){
//            Log::error(implode(' | ', array(__CLASS__, __FUNCTION__, __LINE__, "task id 为{$id} 用户非相关人士")));
//            return false;
//        }
        $role = ($task['user_id'] == $user['id']) ? 1 : 2;
        $agreeUser = array();
        if(!empty($getTask['user_id'])){
            $agreeUser = User::findOrFail($getTask['user_id'])->toArray();
        }

//        if(empty($agreeUser)){
//            Log::error(implode(' | ',array(__CLASS__,__FUNCTION__,__LINE__,"task id 为{$id} 领取用户不存在")));
//            return false;
//        }
        $publishUser = User::findOrFail($task['user_id'])->toArray();
        $result = array(
            'role' => $role,
            'publishUser' => $publishUser,
            'task' => $task,
            'agreeUser' => $agreeUser,
        );
        return view('buxian.detail')->with(['result' => $result]);
    }


}
