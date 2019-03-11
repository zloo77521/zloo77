<?php

namespace App\Http\Controllers;

use App\Models\Nva;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NvaController extends Controller
{
    //页面管理
    public function __construct()
    {
        //设置中间件
        $this->middleware('auth');
    }

    //增加页面
    public function create(){
     $permissions =  Permission::all();
     $nvas =Nva::where('pid',0)->get();
        return view('nva.create',compact('permissions','nvas'));
    }
    //保存页面

    public function store(Request $request){
        //数据验证
        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'url'=>'required',
                'permission_id'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'url.required'=>'地址不能为空',
                'permission_id.required'=>'权限没选择',
            ]
        );
            Nva::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid,
        ]);
        //提示信息
        $request->session()->flash('success','添加成功');
        return redirect()->route('nvas.index');
    }

    //页面列表
    public function index(Request $request)
    {
        $keyword = $request->keyword;
            $nvas = Nva::paginate(10);
            $Dmenus = Nva::where('pid',0)->get();
            $menus = Nva::where('pid','!=',0)->get();
        return view('nva.index',compact('nvas','Dmenus','menus','keyword'));
    }
    //修改页面
    public function edit(nva $nva)
    {
        $permissions =  Permission::all();
//        dd($permissions);
        $pids =Nva::where('pid',0)->get();
        return view('nva.edit',compact('permissions','pids','nva'));
    }

    //保存修改用户
    public function update(nva $nva,Request $request)
    {

        $this->validate($request,
            [//验证规则
                'name'=>'required',
                'url'=>'required',
                'permission_id'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'password.required'=>'地址不能为空',
                'permission_id.required'=>'权限没选择',
            ]
        );
        $nva->url = $request->url;
        $nva->name = $request->name;
        $nva->permission_id = $request->permission_id;
        $nva->pid = $request->pid;
        $nva->save();

        //提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('nvas.index');
    }
    //删除管理员
    public function destroy(nva $nva)
    {
        $nva->delete();
        session()->flash('success','删除成功');
        return redirect()->route('nvas.index');
    }

}
