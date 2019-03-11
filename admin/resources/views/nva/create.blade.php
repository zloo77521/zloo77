@extends('layout.app')

@section('contents')
    @include('vendor.ueditor.assets')
    <h1>添加页面</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('nvas.store') }}" >
        <div class="form-group">
            <label>页面名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>页面地址</label>
            <input type="text" name="url" class="form-control" value="{{ old('url') }}">
        </div>
        <div class="form-group">
            <label>页面权限</label>
            @foreach($permissions as $permission)
            <input type="radio" name="permission_id"  value="{{$permission->id}}"/>{{$permission->name}}
            @endforeach
        </div>
        <div class="form-group">
            <label>上级页面</label>
                <select name="pid">
                    <option value="0" selected>顶级页面</option>
                    @foreach($nvas as $nva)
                    <option value="{{$nva->id}}">{{$nva->name}}</option>
                    @endforeach
                </select>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
    @stop