<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;

class ShopController extends Controller
{

    //添加信息和商家用户页面
    public function create(){
        //获取商家分类s
        $shop_cates = ShopCate::all();
        return view('shop.create',compact('shop_cates'));
    }
    //保存添加商家用户
    public function store(Request $request){
        //数据验证
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'email'=>'required',
                'shop_name'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'piao'=>'required',
                'zhun'=>'required',
                'notice'=>'required',
                'discount'=>'required',
                'img'=>'required|image|max:1024',
                'shop_img'=>'required|image|max:1024',
                'captcha'=>'required|captcha',
            ],
            [//错误提示信息
                'name.required'=>'商家账号不能为空',
                'password.required'=>'密码不能为空',
                'captcha.required'=>'验证码未填写',
                'captcha.captcha'=>'验证码不正确',
                'img.required'=>'请上传头像',
                'img.image'=>'头像格式不正确',
                'img.max'=>'头像大小不能超过1024K',
                'shop_img.required'=>'请上传商家图片',
                'shop_img.image'=>'商家图片格式不正确',
                'shop_img.max'=>'商家图片大小不能超过1024K',
                'email.required'=>'邮箱不能为空',
                'shop_name.required'=>'店铺名称不能为空',
                'start_send.required'=>'起送金额不能为空',
                'send_cost.required'=>'配送费不能为空',
                'notice.required'=>'店铺公告不能为空',
                'discount.required'=>'优惠信息不能为空',
                'brand.required'=>'请选择是否是品牌',
                'on_time.required'=>'请选择是否是准时送达',
                'fengniao.required'=>'请选择是否是ZLOO77配送',
                'bao.required'=>'请选择是否是保标记',
                'piao.required'=>'请选择是否是票标记',
                'zhun.required'=>'请选择是否是准标记',
            ] );

        //图片处理
        $img = $request->file('img');
        $path = $img->store('public/user');
        $shop_img = $request->file('img');
        $path2 = $img->store('public/shop');
        DB::beginTransaction();
        //保存店铺信息
       $aa=  Shop::create([
            'shop_category_id'=>$request->shop_cate_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>url(Storage::url($path2)),
            'shop_rating'=>5,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>0,
        ]);
//dd($aa->id);
        //保存商家账号
       $bb =  User::create([
            'password'=>Hash::make($request->password),
            'name'=>$request->name,
            'img'=>url(Storage::url($path)),
            'email'=>$request->email,
            'shop_id'=>$aa->id,
            'status'=>1,
        ]);
       if($aa&&$bb){
           DB::commit();
       }else{
           DB::rollBack();
       }

        //提示信息
        $request->session()->flash('success','注册商家添加成功');
        return redirect()->route('shops.index');
    }

    //商家列表
    public function index(Request $request)
    {
        //分页显示商品列表
        $keyword = $request->keyword;
        if($keyword){
            $users = User::where('name','like',"%$keyword%")->paginate(3);
        }else{
            $users = User::paginate(3);
        }
        return view('shop.index',compact('users','keyword'));
    }

    //店铺启用或禁用
    public function status(user $user){
        if($user->shop->status ==1){
            $user->shop->status = -1;
            $user->shop->save();
        }else{
            $user->shop->status = 1;
            $user->shop->save();
        }
        return redirect()->route('shops.index');

    }
    //商家启用或禁用
    public function statuss(user $user){
        if($user->status ==1){
            $user->status = 0;
            $user->save();
        }else{
            $user->status = 1;
            $user->save();
        }
        return redirect()->route('shops.index');

    }
      //删除商家
    public function destroy(user $user)
    {
        $user->delete();
        $user->shop()->delete();
        session()->flash('success','商家删除成功');
        return redirect()->route('shops.index');
    }
    //重置密码页面
    public function edit(User $User)
    {
        return view('shop.edit',compact('User'));
    }
    //保存密码
    public function update(user $user,Request $request)
    {
        $this->validate($request,
            [//验证规则
                'password'=>'required',
            ],
            [//错误提示信息
                'password.required'=>'密码不能为空',
            ]
        );
        $user->password = Hash::make($request->password);
        $user->save();
        //提示信息
        $request->session()->flash('success','重置密码成功');
        return redirect()->route('shops.index');
    }

}
