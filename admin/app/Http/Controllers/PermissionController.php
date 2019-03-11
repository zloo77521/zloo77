<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //权限控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //增加权限页面
    public function create(){

        return view('permission.create');
    }
    //保存权限
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
            ]
        );
    $perminssion =  Permission::create(['name'=>$request->name,]);
        //提示信息
        $request->session()->flash('success','添加成功');
        return redirect()->route('permissions.index');
    }
    //权限列表
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        //分页显示商品列表
            $permissions = Permission::paginate(10);
        return view('permission.index',compact('permissions','keyword'));
    }
    //修改权限页面
    public function edit(permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }
    //保存修改
    public function update(permission $permission,Request $request)
    {
        $this->validate($request,
            [//验证规则
                'name'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'权限名称不能为空',
            ]
        );
        $permission->name = $request->name;
        $permission->save();
        //提示信息
        $request->session()->flash('success','权限修改成功');
        return redirect()->route('permissions.index');
    }
    //删除权限
    public function destroy(permission $permission)
    {
        $permission->delete();
        session()->flash('success','权限删除成功');
        return redirect()->route('permissions.index');
    }
}
