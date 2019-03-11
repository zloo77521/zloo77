@extends('layout.app')

@section('contents')
    <h1>修改分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('menu_cates.update',[$MenuCate]) }}" >
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ $MenuCate->name }}">
        </div>
        <div class="form-group">
            <label>分类描述</label>
            <input type="text" name="description" class="form-control" value="{{ $MenuCate->description }}">
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交修改</button>
    </form>
    @stop