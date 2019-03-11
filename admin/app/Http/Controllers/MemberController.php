<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //会员控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //会员列表
    public function index(Request $request){
        //分页显示商品列表
        $keyword = $request->keyword;
        if($keyword){
            $members = Member::where('username','like',"%$keyword%")->paginate(5);
        }else{
            $members = Member::paginate(5);
        }
        return view('member.index',compact('members','keyword'));
    }
    //查看指定会员详情
    public function show(member $member){
//        var_dump($member);exit;
        return view('member.show',compact('member'));
    }

}
