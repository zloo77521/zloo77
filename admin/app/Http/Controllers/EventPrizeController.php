<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //奖品控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //添加奖品页面
    public function create(){
        $date = date('Y-m-d H:i:s');
        $events = Event::where('signup_end','>=',$date)->get();
        return view('event_prize.create',compact('events'));
    }
    //保存添加奖品
    public function store(Request $request){
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'description'=>'required',
                'events_id'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'奖品名称不能为空',
                'description.required'=>'详情不能为空',
                'events_id.required'=>'没有选择最新活动',
            ]
        );
        EventPrize::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'events_id'=>$request->events_id,
            'member_id'=>0,
        ]);
        //提示信息
        $request->session()->flash('success','添加奖品成功');
        return redirect()->route('event_prizes.index');
    }
    //奖品列表
    public function index(Request $request){
        $keyword = $request->keyword;
        $event_prizes = EventPrize::paginate(5);
        return view('event_prize.index',compact('event_prizes','keyword'));
    }
    //删除抽奖
    public function destroy(EventPrize $EventPrize)
    {
        $EventPrize->delete();
        session()->flash('success','奖品删除成功');
        return redirect()->route('event_prizes.index');
    }
    //修改奖品页面
    public function edit(EventPrize $EventPrize){
        $date = date('Y-m-d H:i:s');
        $events = Event::where('signup_end','>=',$date)->get();
        return view('event_prize.edit',compact('EventPrize','events'));
    }
    //保存修改抽奖
    public function update(EventPrize $EventPrize,Request $request){
//数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'description'=>'required',
                'events_id'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'奖品名称不能为空',
                'description.required'=>'详情不能为空',
                'events_id.required'=>'没有选择最新活动',
            ]
        );
        $EventPrize->name = $request->name;
        $EventPrize->description = $request->description;
        $EventPrize->events_id = $request->events_id;
        $EventPrize->save();
        //提示信息
        $request->session()->flash('success','奖品修改成功');
        return redirect()->route('event_prizes.index');
    }
    //查看奖品详情
    public function show(EventPrize $EventPrize){
        $date = date('Y-m-d H:i:s');
        $events = Event::where('signup_end','>=',$date)->get();
        return view('event_prize.show',compact('EventPrize','events'));
    }
}
