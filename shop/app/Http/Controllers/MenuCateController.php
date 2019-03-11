<?php

namespace App\Http\Controllers;

use App\Models\MenuCate;
use Illuminate\Http\Request;

class MenuCateController extends Controller
{
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //添加菜品分类页面
    public function create()
    {
        return view('menu_cate.create');
    }
    //保存分类
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'description'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'分类名不能为空',
                'description.required'=>'分类描述不能为空',
            ]
        );
        MenuCate::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'type_accumulation'=>$request->name,
            'shop_id'=>auth()->user()->shop_id,
            'is_selected'=>0,
        ]);
        //提示信息
        $request->session()->flash('success','分类添加成功');
        return redirect()->route('menu_cates.index');
    }
    //分类列表
    public function index(Request $request)
    {
        //分页显示商品列表
        $keyword = $request->keyword;
        if($keyword){
            $menu_cates = MenuCate::where('shop_id',auth()->user()->shop_id)->where('name','like',"%$keyword%")->paginate(3);
        }else{
            $menu_cates = MenuCate::where('shop_id',auth()->user()->shop_id)->paginate(3);
        }
        return view('menu_cate.index',compact('menu_cates','keyword'));
    }
    //修改页面
    public function edit(MenuCate $MenuCate)
    {
        return view('menu_cate.edit',compact('MenuCate'));
    }
    //保存修改
    public function update(MenuCate $MenuCate,Request $request)
    {

        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'description'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'分类名不能为空',
                'description.required'=>'分类描述不能为空',
            ]
        );
        $MenuCate->name = $request->name;
        $MenuCate->description = $request->description;
        $MenuCate->save();

        //提示信息
        $request->session()->flash('success','分类修改成功');
        return redirect()->route('menu_cates.index');
    }
    //删除商品
    public function destroy(MenuCate $MenuCate)
    {
        $MenuCate->delete();
        session()->flash('success','分类删除成功');
        return redirect()->route('menu_cates.index');
    }
    //成为默认
    public function status(MenuCate $MenuCate){
       MenuCate::where('is_selected',1)->update(['is_selected'=>0]);
        $MenuCate->is_selected = 1;
        $MenuCate->save();
        return redirect()->route('menu_cates.index');
    }
}
