@extends('layout.app')

@section('contents')
    <h1>修改分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('shop_cates.update',[$ShopCate]) }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ $ShopCate->name }}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="file" name="img" >
            <img src="{{ $ShopCate->img}}">
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop