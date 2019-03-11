@extends('layout.app')

@section('contents')
    @include('vendor.ueditor.assets')
    <h1>添加角色</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('roles.store') }}" >
        <div class="form-group">
            <label>角色名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>权限</label>
            @foreach($permissions as $permission)
            <input type="checkbox" name="permission[]"  value="{{$permission->name}}"/>{{$permission->name}}
            @endforeach
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
    @stop