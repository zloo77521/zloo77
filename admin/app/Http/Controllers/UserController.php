<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //删除商家
    public function destroy(user $user)
    {
        $user->delete();
        $user->shop()->delete();
        session()->flash('success','商家删除成功');
        return redirect()->route('shops.index');
    }
    //重置密码页面
    public function edit(user $user)
    {

        return view('shop.edit',compact('user'));
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
