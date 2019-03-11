<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use Illuminate\Http\Request;

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
        $event_members = EventMember::where('events_id',$Event->id)->get();

        return view('event_member.show',compact('event_members','Event'));
    }
}
