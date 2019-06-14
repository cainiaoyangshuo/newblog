<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * 任务列表
     * return
     *
     */
    public function index(Request $request)
    {

        $page = $request->get('page');

        if (!isset($page)) {
            return false;
        }
        $pageSize = 3;
        $list = Tasks::getTaskList(true, true, $page, $pageSize);
        $count = $list['count'];
        $list = $list['list'];

        $results = [];

        foreach ($list as $value) {

            $user = DB::table('buxian_user')->where('id', $value->user_id)->first();

            $result['id'] = $value->id;
            $result['title'] = $value->title;
            $result['content'] = $value->content;
            $result['time'] = $value->created_at;
            $result['user_id'] = $value->user_id;
            $result['user_name'] = $user->name;
            $result['head_image'] = $user->head_image;
            $results[] = $result;
        }

        $re['list'] = $results;
        $re['pageCount'] = ceil($count/$pageSize);

        return view('task.index')->with($re);
    }

    public function detail(Request $request)
    {
        $id = $request->get('task_id');
        
    }
}