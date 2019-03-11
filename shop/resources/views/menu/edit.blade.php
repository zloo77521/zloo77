@extends('layout.app')

@section('contents')
    <h1>修改菜品信息</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('menus.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>菜品名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ $Menu->menu_name }}">
        </div>
        <div class="form-group">
            <label>菜品描述</label>
            <input type="text" name="description" class="form-control" value="{{ $Menu->description }}">
        </div>
        <div class="form-group">
            <label>菜品价格</label>
            <input type="text" name="goods_price" class="form-control" value="{{ $Menu->menu_price }}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{ $Menu->tips }}">
        </div>
        <div class="form-group">
            <label>菜品图片</label>
            <input type="file" name="goods_img" >
            <img src="{{ $Menu->goods_img}}">
        </div>
        <hr/>
        <div class="form-group">
            <label>商加所属分类</label>
            <select name="menu_cate_id" class="form-control">
                @foreach($menu_cates as $menu_cate)
                    <option value="{{ $menu_cate->id }}"
                            @if($Menu->menu_cate_id==$menu_cate->id) selected @endif
                    >{{ $menu_cate->name }}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop