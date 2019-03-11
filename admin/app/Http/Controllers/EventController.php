<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //抽奖控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //添加抽奖页面
    public function create(){
        return view('event.create');
    }
    //保存添加抽奖
    public function store(Request $request){
        //数据验证
        $this->validate($request,
            [//验证规则
                'title'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'signup_num'=>'required',
                'details'=>'required',
            ],
            [//错误提示信息
                'title.required'=>'标题不能为空',
                'details.required'=>'内容不能为空',
                'signup_start.required'=>'开始时间不能为空',
                'signup_end.required'=>'结束时间不能为空',
                'signup_num.required'=>'人数上限不能为空',
            ]
        );
        Event::create([
            'title'=>$request->title,
            'details'=>$request->details,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'signup_num'=>$request->signup_num,
            'prize_date'=>$request->signup_end,
            'is_prize'=>1,
        ]);
        //提示信息
        $request->session()->flash('success','活动发布成功');
        return redirect()->route('events.index');
    }
    //抽奖列表
    public function index(Request $request){
        $keyword = $request->keyword;
       $events = Event::paginate(5);
        return view('event.index',compact('events','keyword'));
    }
    //删除抽奖
    public function destroy(event $event)
    {
        $event->delete();
        session()->flash('success','抽奖删除成功');
        return redirect()->route('event.index');
    }
    //修改抽奖页面
    public function edit(event $event){
        return view('event.edit',compact('event'));
    }
    //保存修改抽奖
    public function update(event $event,Request $request){

        //数据验证
        $this->validate($request,
            [//验证规则
                'title'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'signup_num'=>'required',
                'details'=>'required',
            ],
            [//错误提示信息
                'title.required'=>'标题不能为空',
                'details.required'=>'内容不能为空',
                'signup_start.required'=>'开始时间不能为空',
                'signup_end.required'=>'结束时间不能为空',
                'signup_num.required'=>'人数上限不能为空',
            ]
        );
        $event->details = $request->details;
        $event->title = $request->title;
        $event->signup_start = $request->signup_start;
        $event->signup_end = $request->signup_end;
        $event->signup_num = $request->signup_num;
        $event->save();
        //提示信息
        $request->session()->flash('success','抽奖修改成功');
        return redirect()->route('events.index');
    }
        //查看结果
    public function show(event $event){
        return view('event.show',compact('event'));
    }
    //开始抽奖
    public function status(event $event){
        $event_members = EventMember::where('events_id',$event->id)->get();
        $status = [];
        foreach ($event_members as $event_member){
            $status[] = $event_member->member_id;
        }
        $status = array_unique($status);
        shuffle($status);
        $event_prizes = EventPrize::where('events_id',$event->id)->get();
        DB::beginTransaction();
        foreach ($event_prizes as $event_prize){
            $event_prize->member_id = array_shift($status);
            $event_prize->save();
        }
        $event->is_prize = 0;
        $event->save();
        if ($event->save()&&$event_prize->save()){
            DB::commit();
        }else{
            DB::rollBack();
        }

        //提示信息
        session()->flash('success','抽奖成功');
        return redirect()->route('events.index');
    }
    //抽奖结果
    public function result(event $event){
        $event_prizes = EventPrize::where('events_id',$event->id)->get();
        return view('event.result',compact('event_prizes','event'));
    }
}
