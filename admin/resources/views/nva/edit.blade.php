@extends('layout.app')

@section('contents')
    <h1>修改页面</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('nvas.update',[$nva]) }}" >
        <div class="form-group">
            <label>页面名称</label>
            <input type="text" name="name" class="form-control" value="{{ $nva->name }}">
        </div>
        <div class="form-group">
            <label>页面地址</label>
            <input type="text" name="url" class="form-control" value="{{ $nva->url }}">
        </div>
        <div class="form-group">
            <label>页面权限</label>
            @foreach($permissions as $permission)
                <input type="radio" name="permission_id"  value="{{$permission->id}}" @if($permission->id == $nva->permission_id) checked @endif/>{{$permission->name}}
            @endforeach
        </div>
        <div class="form-group">
            <label>上级页面</label>
            <select name="pid">
                <option value="0" >顶级页面</option>
                @foreach($pids as $pid)
                    <option value="{{$pid->id}}" @if($pid->id ==$nva->pid) selected @endif>{{$pid->name}}</option>
            @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop