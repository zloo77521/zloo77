@extends('layout.app')

@section('contents')
    <h1>修改密码</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('users.updatepwd') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label><h4>商家账号：{{ auth()->user()->name }}</h4></label>
        </div>
        <div class="form-group">
            <label>原来密码</label>
            <input type="password" name="password1" class="form-control" value="{{ old('password1') }}">
        </div>
        <div class="form-group">
            <label>新密码</label>
            <input type="password" name="password2" class="form-control" value="{{ old('password2') }}">
        </div>
        <div class="form-group">
            <label>确认密码</label>
            <input type="password" name="password3" class="form-control" value="{{ old('password3') }}">
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-success">提交</button>
    </form>
    @stop