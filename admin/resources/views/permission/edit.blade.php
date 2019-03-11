@extends('layout.app')

@section('contents')
    <h1>修改权限</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('permissions.update',[$permission]) }}" >
        <div class="form-group">
            <label>权限名称</label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop