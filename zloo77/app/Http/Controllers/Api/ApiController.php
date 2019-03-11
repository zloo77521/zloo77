<?php

namespace App\Http\Controllers\Api;

use App\Models\Addresse;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\MenuCate;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;

class ApiController extends Controller
{
//    //安全设置
//    public function __construct()
//    {
//        $this->middleware('guest',[
//            'only'=>['loginCheck','sms']
//        ]);
//    }
    //店铺列表接口
    public function  businessList(Request $request){
        $keyword = $request->keyword;
        if($keyword){
            $shops = Shop::where('status',1)->where('shop_name','like',"%$keyword%")->get();
        }else{
            $shops = Shop::where('status',1)->get();
        }
//        var_dump($shops);exit;
       return $shops;

    }
    //指定商铺
    public function business(Request $request){
        $id = $request->id;
        $shops = Shop::find($id);
        $cates = MenuCate::where('shop_id',$id)->get();

        foreach ($cates as $cate){
            $cate['goods_list'] =  Menu::where('category_id',$cate->id)->get();
        }
        $shops['commodity'] =$cates;
        return $shops;
    }
    //登录验证
    public function loginCheck(Request $request){
        if(Auth::attempt([
            'username'=>$request->name,
            'password'=>$request->password
        ],$request->has('rememberMe'))){
            return ['status'=>'true','message'=>"登录成功", "user_id"=>auth()->user()->id,"username"=>$request->name];
         }else{
            return ['status'=>'false','message'=>"密码账号错误"];
        }
    }
    //短信验证
    public function sms(Request $request){
        $appid = 1400187984; // 1400开头
        $appkey = "765b19698cde09bda9f3624f3f8a68bd";
        $phoneNumber = $request->tel;//手机号码
        $templateId = 285014;  //模板
        $smsSign = "弱噢噢私人分享"; // `签名内容`
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $redis_num = mt_rand(1000,9999);
            $params = [$redis_num,5];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");
            $result = json_decode($result);

            if($result->errmsg == 'OK'){
                Redis::set($phoneNumber, $redis_num);
                Redis::expire($phoneNumber,300);
                return ['status'=>'true','message'=>"发送短信验证码成功"];
            }else{
                return ['status'=>'false','message'=>"发送短信验证码失败"];
            }
        } catch(\Exception $e) {
            return ['status'=>'false','message'=>"发送短信验证码失败"];
        }

    }
    //注册用户
    public function regist(Request $request){

        if($request->sms == Redis::get($request->tel)){
        $regist = Member::create([
            'password'=>Hash::make($request->password),
            'username'=>$request->username,
            'tel'=>$request->tel,
        ]);
        if($regist){
           return ['status'=>'true','message'=>"注册成功"];
       }else{
          return ['status'=>'false','message'=>"注册失败"];
        }
        }
        return ['status'=>'false','message'=>"验证码错误"];
    }
    //添加收货地址
    public function addAddress(Request $request){
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'tel'=>'required',
                'provence'=>'required',
                'city'=>'required',
                'area'=>'required',
                'detail_address'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'收货人不能为空',
                'tel.required'=>'联系人不能为空',
                'provence.required'=>'省地址不能空',
                'city.required'=>'市地址不能为空',
                'area.required'=>'区地址不能为空',
                'detail_address.required'=>'详细地址不能为空',
            ]
        );
        //保存数据
       $add =  Addresse::create([
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'tel'=>$request->tel,
            'provence'=>$request->provence,
            'city'=>$request->city,
            'area'=>$request->area,
            'detail_address'=>$request->detail_address,
            'is_default'=>0,
        ]);
       if($add){
           return ['status'=>'true','message'=>"添加成功"];
       }else{
           return ['status'=>'false','message'=>"添加失败"];
       }
    }
    //收货地址列表
    public function addressList(){
             return $address = Addresse::where('user_id',auth()->user()->id)->get();
    }
    //修改收货地址页面
    public function address(Request $request){
         $address = Addresse::where('id',$request->id)->get();
         return $address[0];
    }
   //保存修改
    public function editAddress(Request $request){
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'tel'=>'required',
                'provence'=>'required',
                'city'=>'required',
                'area'=>'required',
                'detail_address'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'收货人不能为空',
                'tel.required'=>'联系人不能为空',
                'provence.required'=>'省地址不能空',
                'city.required'=>'市地址不能为空',
                'area.required'=>'区地址不能为空',
                'detail_address.required'=>'详细地址不能为空',
            ]
        );
        //保存数据
        $Addresse =  Addresse::find($request->id);
        $Addresse ->name = $request->name;
        $Addresse ->tel = $request->tel;
        $Addresse ->provence = $request->provence;
        $Addresse ->city = $request->city;
        $Addresse ->area = $request->area;
        $Addresse ->detail_address = $request->detail_address;
        $Addresse->save();
        if ($Addresse->save()){
            return ['status'=>'true','message'=>"修改成功"];
        }else{
            return ['status'=>'false','message'=>"修改失败"];
        }
    }

    // 保存购物车接口
    public function addCart(Request $request){

        $goodsList = $request->goodsList;
        $goodsCount = $request->goodsCount;

        for($i=0; $i < count($goodsList);$i++ ){
            $cart = new Cart();
            $cart->user_id = auth()->user()->id;
            $cart->goods_id = $goodsList[$i];
            $cart->amount = $goodsCount[$i];
            $cart->save();
        }
        return ['status'=>'true','message'=>"添加成功"];
    }
    // 获取购物车数据接口
    public function cart(){
        $cate = Cart::where('user_id','=',\auth()->user()->id)->get();
        $totalCost =0;
        foreach($cate as $a){
            $data = Menu::where('goods_id',$a->goods_id)->first();
            $a['goods_name'] = $data->goods_name;
            $a['goods_img'] = $data->goods_img;
            $a['goods_price'] = $data->goods_price;
            $totalCost += $a->amount * $a->goods_price;
        }
        $datar['goods_list']=$cate;
        $datar['totalCost']=$totalCost;
        return $datar;

    }
    //添加订单
    public function addOrder(Request $request){
        $this->validate($request,
            [//验证规则
                'address_id'=>'required',
            ],
            [//错误提示信息
                'address_id.required'=>'收货地址不能为空',
            ]
        );
        DB::beginTransaction();
        $address_id = $request->address_id;
        $addresse = Addresse::where('id',$address_id)->first();
        $cart = Cart::where('user_id',auth()->user()->id)->first();
        $menu = Menu::where('goods_id',$cart->goods_id)->first();
        $totalCost =0;
        $data = Cart::where('user_id',auth()->user()->id)->get();
        foreach($data as $a){
            $cc = Menu::where('goods_id',$a->goods_id)->first();
            $totalCost += $a->amount * $cc->goods_price;
        }
        $aa = Order::create([
            'user_id'=>auth()->user()->id,
            'provence'=>$addresse->provence,
            'city'=>$addresse->city,
            'area'=>$addresse->area,
            'detail_address'=>$addresse->detail_address,
            'name'=>$addresse->name,
            'tel'=>$addresse->tel,
            'order_code'=>date('Y-m-d H:i:s'),
            'order_birth_time'=>date('Y-m-d H:i:s'),
            'order_price'=>$totalCost,
            'out_trade_no'=>1,
            'shop_id'=>$menu->shop_id,
            'order_status'=>1,
        ]);

        $bb = OrderDetail::create([
            'order_id'=>$aa->id,
            'goods_id'=>$cart->goods_id,
            'amount'=>$cart->amount,
            'goods_name'=>$menu->goods_name,
            'goods_img'=>$menu->goods_img,
            'goods_price'=>$menu->goods_price,
        ]);
        if ($aa&&$bb){
            DB::commit();
            $appid = 1400187984; // 1400开头
            $appkey = "765b19698cde09bda9f3624f3f8a68bd";
            $phoneNumber = $addresse->tel;//手机号码
            $templateId = 285014;  //模板
            $smsSign = "弱噢噢私人分享"; // `签名内容`
            try {
                $ssender = new SmsSingleSender($appid, $appkey);
                $redis_num = mt_rand(1000,9999);
                $params = [$redis_num,5];
                $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                    $params, $smsSign, "", "");
                $result = json_decode($result);

                if($result->errmsg == 'OK'){
                    Redis::set($phoneNumber, $redis_num);
                    Redis::expire($phoneNumber,300);
                    return ['status'=>'true','message'=>"添加成功",'order_id'=>$aa->id];
                }else{
                    return ['status'=>'true','message'=>"添加成功",'order_id'=>$aa->id];
                }
            } catch(\Exception $e) {
                return ['status'=>'true','message'=>"添加成功",'order_id'=>$aa->id];
            }
        }else{
            DB::rollBack();
            return ['status'=>'false','message'=>"不好意思网络有问题"];
        }
    }
    //指定订单
    public function order(Request $request){
        $order = Order::where('id',$request->id)->first();
        $shop = Shop::where('id',$order->shop_id)->first();
        $order['shop_name'] = $shop->shop_name;
        $order['shop_img'] = $shop->shop_img;
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach ($carts as $cart){
            $menu = Menu::where('goods_id',$cart->goods_id)->first();
            $cart['goods_name'] = $menu->goods_name;
            $cart['goods_img'] = $menu->goods_img;
            $cart['goods_price'] = $menu->goods_price;
        }
        $order['goods_list'] =$carts;
        $order['order_address'] = $order->provence.$order->city.$order->area.$order->detail_address;
        return $order;

    }
    //订单列表
    public function orderList(){
        $orders = Order::where('user_id',auth()->user()->id)->get();
//        return $orders;
        foreach ($orders as $order){
            $detail = OrderDetail::where('order_id',$order->id)->get();
            $order['goods_list'] =$detail;
            $goods = Menu::where('goods_id',$detail[0]->goods_id)->first();
            $shop = Shop::where('id',$goods->shop_id)->first();
            $order['shop_name'] = $shop->shop_name;
            $order['shop_img'] = $shop->shop_img;
            $order['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
        }
        return $orders;
    }
    //修改密码
    public function changePassword(Request $request){
        $this->validate($request,
            [//验证规则
                'oldPassword'=>'required',
                'newPassword'=>'required',
            ],
            [//错误提示信息
                'oldPassword.required'=>'旧密码不能为空',
                'oldPassword.required'=>'新密码不能为空',
            ]
        );
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $member = Member::where('id',auth()->user()->id)->first();
        if(Hash::check($oldPassword,Auth()->user()->password)){
            $member->password = Hash::make($newPassword);
            $member->save();
            return ['status'=>'true','message'=>"修改成功"];
        }else{
            return ['status'=>'false','message'=>"旧密码不正确"];
        }

    }
    //忘记密码
    public function forgetPassword(Request $request){
        if($request->sms == Redis::get($request->tel)){
            $member = Member::where('tel',$request->tel)->first();
            $member->password = Hash::make($request->password);
            $member->save();
            return ['status'=>'true','message'=>"修改成功"];
            }else{
            return ['status'=>'false','message'=>"验证码错误"];
        }
    }

}
