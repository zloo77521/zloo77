@extends('layout.app')

@section('contents')
    <h1>修改角色</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('roles.update',[$role]) }}" >
        <div class="form-group">
            <label>角色名称</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}">
        </div>
        <div class="form-group">
            <label>权限</label>
            @foreach($permissions as $permission)
                <input type="checkbox" name="permission[]"  value="{{$permission->name}}" @if($role->hasPermissionTo($permission)) checked @endif />{{$permission->name}}
            @endforeach
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop