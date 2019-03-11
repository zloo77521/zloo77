@extends('layout.app')

@section('contents')
    <h1>添加管理员</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('admins.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>管理员账号</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>管理员密码</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>管理员头像</label>
            <input type="file" name="img" >
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input type="text" name="captcha" class="form-control">
            <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>


        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">增加管理员</button>
    </form>
    @stop