<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;

use App\Tasks;
use App\BuxianTasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;

class TasksController extends BaseController
{
    /**
     * 任务列表
     * return
     *
     */
    public function index()
    {

        //$page = $request->get('page');
        //
        //if (!isset($page)) {
        //    return false;
        //}

        $list = Tasks::getTaskList();

        $results = [];

        foreach ($list as $value) {

            $user = DB::table('buxian_user')->where('id', $value->user_id)->first();

            $result['id'] = $value->id;
            $result['category'] = Tasks::$categorys[$value->category];
            $result['content'] = $value->content;
            $result['time'] = $value->created_at;
            $result['user_id'] = $value->user_id;
            $result['user_name'] = $user->user_name;
            $result['head_image'] = $user->head_image;
            $results[] = $result;
        }

        $list = $results;

        return view('buxian.index')->with(['list' => $list]);
    }

    public function detail(Request $request)
    {
        $id = $request->get('task_id');
        var_dump($id);exit;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create')->with('category_list',BuxianTasks::$categorys)->with('sex_list',BuxianTasks::$sexs);
    }

    /**
     * Store a newly created resource in storage.
     *\App\Http\Requests\CreateArticleRequest
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接受post方法
        $requestArray = $request->all();
        // 有效天数，转化为时间戳
        if(isset($requestArray['valid_at']) || $requestArray['valid_at'] > 0){
            $date = date('Y-m-d H:i:s',time() + $requestArray['valid_at'] * 86400);
            $requestArray['valid_at'] = Carbon::createFromFormat('Y-m-d H:i:s',$date);
        }
        $requestArray['content'] = isset($requestArray['content']) ? $requestArray['content'] : '';
        $result = BuxianTasks::create(array_merge(array('user_id'=>1,'status'=>1), $requestArray));
        $jsonData = (isset($result['id']) && ($result['id'] > 0)) ? $this->returnJsonData($result['id']) : $this->returnJsonData('',1004,'插入失败');
        return $jsonData;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = BuxianTasks::findOrFail($id);
        return view('tasks.show',compact('task'));
    }


}