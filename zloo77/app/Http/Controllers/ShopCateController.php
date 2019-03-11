<?php

namespace App\Http\Controllers;

use App\Models\ShopCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCateController extends Controller
{
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //添加分类
    public function create()
    {
        return view('shop_cate.create');
    }
    //保存分类
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'img'=>'required|image|max:1024',
            ],
            [//错误提示信息
                'name.required'=>'分类名不能为空',
                'img.required'=>'请上传图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过1024K',
            ]
        );
        //处理图片文件
        $img = $request->file('img');
        $path = $img->store('public/admin');
        ShopCate::create([
            'name'=>$request->name,
            'img'=>url(Storage::url($path)),
            'status'=>1,
        ]);
        //提示信息
        $request->session()->flash('success','分类添加成功');
        return redirect()->route('shop_cates.index');
    }
    //分类列表
    public function index(Request $request)
    {
        //分页显示商品列表
        $keyword = $request->keyword;
        if($keyword){
            $shop_cates = ShopCate::where('name','like',"%$keyword%")->paginate(3);
        }else{
            $shop_cates = ShopCate::paginate(3);
        }
        return view('shop_cate.index',compact('shop_cates','keyword'));
    }
    //修改页面
    public function edit(ShopCate $ShopCate)
    {
        return view('shop_cate.edit',compact('ShopCate'));
    }
    //保存修改
    public function update(ShopCate $ShopCate,Request $request)
    {

        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'img'=>'required|image|max:1024',
            ],
            [//错误提示信息
                'name.required'=>'分类名不能为空',
                'img.required'=>'请上传图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过1024K',
            ]
        );
        //处理图片文件
        $img = $request->file('img');
        $path = $img->store('public/admin');

        $ShopCate->name = $request->name;
        $ShopCate->img = url(Storage::url($path));
        $ShopCate->save();

        //提示信息
        $request->session()->flash('success','分类修改成功');
        return redirect()->route('shop_cates.index');
    }
    //删除商品
    public function destroy(ShopCate $ShopCate)
    {
        $ShopCate->delete();
        session()->flash('success','分类删除成功');
        return redirect()->route('shop_cates.index');
    }
}
