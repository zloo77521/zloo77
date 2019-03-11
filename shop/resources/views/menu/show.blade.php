@extends('layout.app')

@section('contents')
    <h1>修改商品</h1>
    @include('layout._errors')
        <div class="form-group">
            <label>商品名称</label>
            <input type="text" name="name" class="form-control" value="{{ $good->name }}">
        </div>
        <div class="form-group">
            <label>商品价格</label>
            <input type="text" name="amount" class="form-control" value="{{ $good->amount }}">
        </div>
        <div class="form-group">
            <label>商品图片</label>
            <img src="{{ $good->img()}}">
        </div>
    <div class="form-group">
        <label>商品点击次数</label>
        <p>{{ $good->browse}}</p>
    </div>
    @stop