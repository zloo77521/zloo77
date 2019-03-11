<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //修改密码页面
    public function editpwd(){
        return view('user.editpwd');
    }
    public function updatepwd(Request $request){
        $this->validate($request,
            [//验证规则
                'password1'=>'required',
                'password2'=>'required',
                'password3'=>'required',
            ],
            [//错误提示信息
                'password1.required'=>'原密码不能为空',
                'password2.required'=>'新密码不能为空',
                'password3.required'=>'确认密码不能为空',
            ]
        );

        if($request->password2 !=$request->password3) {
            return back()->with('danger', '两次密码不一致');
        }
            if(Hash::check($request->password1,Auth()->user()->password)){
            $user = Auth::user();
            $user->password = Hash::make($request->password2);
                $user->save();
                Auth::logout();
                return redirect()->intended(route('shops.index'))->with('success','修改密码成功');
            }else{
                return back()->with('danger','原密码不正确');
            }
        }

}
