@extends('layout.app')

@section('contents')
    <h1>管理员登陆</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('login') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>管理员账号</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>管理员密码</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input type="text" name="captcha" class="form-control">
            <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="rememberMe" value="1"> 下次自动登陆
            </label>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop