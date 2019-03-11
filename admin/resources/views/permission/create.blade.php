@extends('layout.app')

@section('contents')
    @include('vendor.ueditor.assets')
    <h1>添加权限</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('permissions.store') }}" >
        <div class="form-group">
            <label>权限名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
    @stop