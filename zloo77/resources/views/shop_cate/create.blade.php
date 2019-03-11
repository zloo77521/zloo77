@extends('layout.app')

@section('contents')
    <h1>添加分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('shop_cates.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="file" name="img" >
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop