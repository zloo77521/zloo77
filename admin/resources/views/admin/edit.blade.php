@extends('layout.app')

@section('contents')
    <h1>修改管理员</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('admins.update',[$admin]) }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>管理员账号</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
        </div>
        <div class="form-group">
            <label>管理员密码</label>
            <input type="text" name="password" class="form-control" value="">
        </div>
        <div class="form-group">
            <label>管理员头像</label>
            <input type="file" name="img" >
            <img src="{{ $admin->img}}">
        </div>
        <div class="form-group">
            <label>权限</label>
            @foreach($roles as $role)
                <input type="checkbox" name="role[]"  value="{{$role->name}}" @if($admin->hasRole($role)) checked @endif />{{$role->name}}
            @endforeach
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop