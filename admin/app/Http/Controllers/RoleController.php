<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //角色控制器
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }
    //增加权限页面
    public function create(){
      $permissions =   Permission::all();

        return view('role.create',compact('permissions'));
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
     $permission = $request->permission;
     $role =  Role::create(['name'=>$request->name,]);
     $role-> syncPermissions($permission);

        //提示信息
        $request->session()->flash('success','添加成功');
        return redirect()->route('roles.index');
    }
    //权限列表
    public function index(Request $request)
    {

        //分页显示商品列表
        $roles = Role::paginate(10);
        return view('role.index',compact('roles'));
    }
    //修改权限页面
    public function edit(role $role)
    {
        $permissions =   Permission::all();
        return view('role.edit',compact('role','permissions'));
    }
    //保存修改用户
    public function update(role $role,Request $request)
    {
        $this->validate($request,
            [//验证规则
                'name'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
            ]
        );
        $permission = $request->permission;
        $role->name = $request->name;
        $role-> syncPermissions($permission);
        $role->save();

        //提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('roles.index');
    }
    //删除管理员
    public function destroy(role $role)
    {
        $role->delete();
        session()->flash('success','删除成功');
        return redirect()->route('roles.index');
    }
}
