<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //订单控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //订单列表
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword){
            $orders = Order::where('shop_id',auth()->user()->shop_id)->where('username','like',"%$keyword%")->paginate(5);
        }else{
            $orders = Order::where('shop_id',auth()->user()->shop_id)->paginate(5);
        }
        return view('order.index',compact('orders','keyword'));
    }
    //指定订单
    public function show(order $order){

        return view('order.show',compact('order'));
    }
    //最近7天订单统计
    public function orderWeek(){
        $shop_id=auth()->user()->shop_id;
        $time_start=date('Y-m-d 00:00:00',strtotime('-6 day'));
        $time_end=date('Y-m-d 23:59:59');
        //group by date(created_at)根据时间分组
        $sql="select date(created_at) as date,count(*) as total from orders where created_at >= '{$time_start}' and created_at <='{$time_end}' and shop_id={$shop_id} group by date(created_at)";
        $rows=DB::select($sql);

        $result=[];
        for ($i=0;$i<7;$i++){
            $result[date('Y-m-d',strtotime("-{$i} day"))]=0;
        }
        foreach ($rows as $row ){
            $result[$row->date]=$row->total;
        }

        return view('order.orderWeek',compact('result'));
    }
    //最近三个月的订单统计
    public function orderMonth(){
        $shop_id=auth()->user()->shop_id;
        $time_start=date('Y-m-1 00:00:00',strtotime('-2 month'));
        $time_end=date('Y-m-30 23:59:59');

        //group by date(created_at)根据时间分组
        $sql="select date('Y-m') as date,count(*) as total from orders where created_at >= '{$time_start}' and created_at <='{$time_end}' and shop_id={$shop_id} group by date('Y-m')";
        $rows=DB::select($sql);
        $result=[];
        for ($i=0;$i<3;$i++){
            $result[date('Y-m',strtotime("-{$i} month"))]=0;
        }
        foreach ($rows as $row ){
            $result[$row->date]=$row->total;
        }
        dd($result);

        return view('order.orderMonth',compact('result'));
    }
}
