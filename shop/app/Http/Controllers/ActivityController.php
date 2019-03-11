<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //活动控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //活动列表
    public function index(Request $request)
    {
        $date = date('Y-m-d H:s',time());
         $activitys = Activity::where([ ['end_time','>=',$date]])->paginate(5);
//         dd($activitys);
        return view('activity.index',compact('activitys'));
    }
    //查看详情
    public function show(activity $activity){
        return view('activity.show',compact('activity'));
    }
}
