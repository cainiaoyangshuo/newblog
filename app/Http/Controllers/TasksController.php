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
}