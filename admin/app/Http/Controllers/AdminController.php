<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }

    //添加管理员
    public function create()
    {
         $roles =    Role::all();
        return view('admin.create',compact('roles'));
    }
    //保存管理员
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'password'=>'required',
                'img'=>'required|image|max:1024',
                'captcha'=>'required|captcha',
            ],
            [//错误提示信息
                'name.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'captcha.required'=>'验证码未填写',
                'captcha.captcha'=>'验证码不正确',
                'img.required'=>'请上传图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过1024K',
            ]
        );
        //处理图片文件
        $img = $request->file('img');
        $path = $img->store('public/admin');
      $admin =   Admin::create([
            'password'=>Hash::make($request->password),
            'name'=>$request->name,
            'img'=>url(Storage::url($path)),
        ]);
        $admin->syncRoles($request->role);
        //提示信息
        $request->session()->flash('success','管理员添加成功');
        return redirect()->route('admins.index');
    }
    //管理员列表
    public function index(Request $request)
    {
        //分页显示商品列表
        $keyword = $request->keyword;
        if($keyword){
            $admins = Admin::where('name','like',"%$keyword%")->paginate(3);
        }else{
            $admins = Admin::paginate(3);
        }
        return view('admin.index',compact('admins','keyword'));
    }

    //修改页面
    public function edit(admin $admin)
    {
        $roles =    Role::all();
        return view('admin.edit',compact('admin','roles'));
    }

    //保存修改用户
    public function update(Admin $Admin,Request $request)
    {

        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'password'=>'required',
                'img'=>'required|image|max:1024',
            ],
            [//错误提示信息
                'name.required'=>'管理员账号不能为空',
                'password.required'=>'密码不能为空',
                'img.required'=>'请上传图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过1024K',
            ]
        );
        //处理图片文件
        $img = $request->file('img');
        $path = $img->store('public/admin');

        $Admin->password = Hash::make($request->password);
        $Admin->name = $request->name;
        $Admin->img = url(Storage::url($path));
        $Admin->save();
        $Admin->syncRoles($request->role);

        //提示信息
        $request->session()->flash('success','管理员修改成功');
        return redirect()->route('admins.index');
    }
    //删除管理员
    public function destroy(admin $admin)
    {
        $admin->delete();
        session()->flash('success','管理员删除成功');
        return redirect()->route('admins.index');
    }
}
