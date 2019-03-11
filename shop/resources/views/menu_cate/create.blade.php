@extends('layout.app')

@section('contents')
    <h1>添加分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('menu_cates.store') }}" >
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>分类描述</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop