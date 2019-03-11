<?php

namespace App\Http\Controllers;

use App\Models\MenuCate;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //添加菜品页面
    public function create()
    {
        //获取所有分类
       $menu_cates =  MenuCate::where('shop_id',auth()->user()->shop_id)->get();
        return view('menu.create',compact('menu_cates'));
    }
    //保存菜品
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            [
                'goods_name'=>'required',
                'description'=>'required',
                'goods_img'=>'required|image|max:1024',
                'tips'=>'required',
                'goods_price'=>'required',
            ],
            [//错误提示信息
                'goods_name.required'=>'菜品名称不能为空',
                'description.required'=>'菜品描述不能为空',
                'goods_price.required'=>'菜品价格不能为空',
                'tips.required'=>'提示信息不能为空',
                'goods_img.required'=>'请上传图片',
                'goods_img.image'=>'图片格式不正确',
                'goods_img.max'=>'图片大小不能超过1024K',
            ]
        );
        //处理图片文件
        $goods_img = $request->file('goods_img');
        $path = $goods_img->store('public/menu');
        //批量保存
        Menu::create([
            'goods_name'=>$request->goods_name,
            'category_id'=>$request->menu_cate_id,
            'description'=>$request->description,
            'goods_price'=>$request->goods_price,
            'tips'=>$request->tips,
            'month_sales'=>0,
            'rating_count'=>0,
            'satisfy_count'=>0,
            'satisfy_rate'=>5,
            'status'=>0,
            'rating'=>5,
            'shop_id'=>auth()->user()->shop->id,
            'goods_img'=>url(Storage::url($path)),
        ]);
        //提示信息
        $request->session()->flash('success','菜品添加成功');
        return redirect()->route('menus.index');
    }
    //菜品列表
    public function index(Request $request)
    {
       $menu_cates =  MenuCate::all();
        //分页显示商品列表
        $keyword = $request->keyword;
        $min = $request->min;
        $max = $request->max;
        $menucateid =$request->menucateid;
        $key = [];
        if($keyword) $key[] = ['goods_name','like',"%$keyword%"];
        if($min)     $key[] = ['goods_price','>=',$min];
        if($max)     $key[] = ['goods_price','<=',$max];
        if($menucateid) $key[] = ['menu_cate_id','=',$menucateid];
//        dd($key);
        if($key){
            $menus = Menu::where('shop_id',auth()->user()->shop_id)->where($key)->paginate(5);
        }else{
            $menus = Menu::where('shop_id',auth()->user()->shop_id)->paginate(5);
        }
        return view('menu.index',compact('menus','keyword','menu_cates','min','max','menucateid'));
    }
    //上架下架
    public function status(menu $menu){
        if($menu->status ==1){
            $menu->status = 0;
            $menu->save();
        }else{
            $menu->status = 1;
            $menu->save();
        }
        return redirect()->route('menus.index');
    }
    //删除商品
    public function destroy(Menu $Menu)
    {
        $Menu->delete();
        session()->flash('success','菜品删除成功');
        return redirect()->route('menus.index');
    }
    //修改页面
    public function edit(Menu $Menu)
    {
        $menu_cates =  MenuCate::where('shop_id',auth()->user()->shop_id)->all();
        return view('menu.edit',compact('Menu','menu_cates'));
    }
    //保存修改
    public function update(Menu $Menu,Request $request)
    {

        //数据验证
        $this->validate($request,
            [
                'goods_name'=>'required',
                'description'=>'required',
                'goods_img'=>'required|image|max:1024',
                'tips'=>'required',
                'goods_price'=>'required',
            ],
            [//错误提示信息
                'goods_name.required'=>'菜品名称不能为空',
                'description.required'=>'菜品描述不能为空',
                'goods_price.required'=>'菜品价格不能为空',
                'tips.required'=>'提示信息不能为空',
                'goods_img.required'=>'请上传图片',
                'goods_img.image'=>'图片格式不正确',
                'goods_img.max'=>'图片大小不能超过1024K',
            ]
        );
        //处理图片文件
        $goods_img = $request->file('goods_img');
        $path = $goods_img->store('public/menu');
        //保存
        $Menu->goods_name = $request->goods_name;
        $Menu->description = $request->description;
        $Menu->category_id = $request->menu_cate_id;
        $Menu->goods_price = $request->goods_price;
        $Menu->goods_img = url(Storage::url($path));
        $Menu->tips = $request->tips;
        $Menu->save();

        //提示信息
        $request->session()->flash('success','菜品修改成功');
        return redirect()->route('menus.index');
    }
}
