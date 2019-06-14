<?php
/**
 * @date 2019/6/14
 */

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * 任务列表
     */
    public function index(Request $request, $page)
    {
var_dump($page);exit;
        $page = $request->get('page');

        if (!isset($page)) {
            return false;
        }
        $pageSize = 3;
        $list = Tasks::getTaskList(true, true, $page, $pageSize);

        $count = $list['count'];
        $re['list'] = $list;
        $re['pageCount'] = ceil($count/$pageSize);
var_dump($re);exit;

        return view()->with($re);
    }
}