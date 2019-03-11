<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //安全设置
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create']
        ]);
    }
    //管理员登录
    public function create()
{
    return view('login.create');
}
public function store(Request $request){

    //验证规则
    $this->validate($request,
        [
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ],
        [
            'name.required'=>'账号不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码未填写',
            'captcha.captcha'=>'验证码不正确',
        ]
    );
    //用户密码验证
    if(Auth::attempt([
        'name'=>$request->name,
        'password'=>$request->password
    ],$request->has('rememberMe'))){
        return redirect()->intended(route('shops.index'))->with('success','登录成功');
    }else{
        return back()->with('danger','账号密码不正确');
    }
}
//用户注销
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','退出成功');
    }


}
