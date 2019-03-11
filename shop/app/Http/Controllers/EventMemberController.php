<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Http\Request;
use App\Models\EventPrize;

class EventMemberController extends Controller
{
    //抽奖报名控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //报名列表
    public function index(Request $request){
        $keyword = $request->keyword;
        $events = Event::paginate(5);
        return view('event_member.index',compact('events','keyword'));
    }
    //指定抽奖报名列表
    public function show(Event $Event){

        return view('event_member.show',compact('event_members','Event'));
    }
    //添加报名
    public function create(Event $Event){
        EventMember::create([
            'events_id'=>$Event->id,
            'member_id'=>auth()->user()->id,
        ]);
        //提示信息
        session()->flash('success','报名成功');
        return redirect()->route('event_members.index');
    }
    //抽奖结果
    public function result(event $event){
        $event_prizes = EventPrize::where('events_id',$event->id)->get();
        return view('event_member.result',compact('event_prizes','event'));
    }
}
