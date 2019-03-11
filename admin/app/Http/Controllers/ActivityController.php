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
    //添加活动页面
    public function create()
    {
        return view('activity.create');
    }

    //保存活动
    public function store(Request $request)
    {

        //数据验证
        $this->validate($request,
            [//验证规则
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ],
            [//错误提示信息
                'title.required'=>'标题不能为空',
                'content.required'=>'内容不能为空',
                'start_time.required'=>'开始时间不能为空',
                'end_time.required'=>'结束时间不能为空',
            ]
        );
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        //提示信息
        $request->session()->flash('success','活动发布成功');
        return redirect()->route('activitys.index');
    }
    //活动列表
    public function index(Request $request)
    {
        $date = date('Y-m-d H:s',time());
//        var_dump($date);exit;
        //分页显示商品列表
        $keyword = $request->keyword;
        $key = [];
        if($keyword ==1) $key[] = ['start_time','>',$date];
        if($keyword ==2) $key = [['start_time','<',$date],['end_time','>',$date]];
        if($keyword ==3) $key[] = ['end_time','<',$date];
        if($keyword){
            $activitys = Activity::where($key)->paginate(5);
        }else{
            $activitys = Activity::paginate(5);
        }
        return view('activity.index',compact('activitys','keyword'));
    }
    //删除活动
    public function destroy(activity $activity)
    {
        $activity->delete();
        session()->flash('success','管理员删除成功');
        return redirect()->route('activitys.index');
    }
    //修改页面
    public function edit(activity $activity)
    {
        return view('activity.edit',compact('activity'));
    }
    //保存修改用户
    public function update(activity $activity,Request $request)
    {

        $this->validate($request,
            [//验证规则
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ],
            [//错误提示信息
                'title.required'=>'标题不能为空',
                'content.required'=>'内容不能为空',
                'start_time.required'=>'开始时间不能为空',
                'end_time.required'=>'结束时间不能为空',
            ]
        );
        $activity->content = $request->input('content');
        $activity->title = $request->title;
        $activity->start_time = $request->start_time;
        $activity->end_time = $request->end_time;
        $activity->save();

        //提示信息
        $request->session()->flash('success','活动修改成功');
        return redirect()->route('activitys.index');
    }
}
