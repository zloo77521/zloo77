@extends('layout.app')


@section('contents')

    <table class="table table-bordered">
        <form class="navbar-form navbar-left" action="{{ route('menus.index') }}">
        <ul class="nav nav-pills">
            <li role="presentation" >
                <select name="menucateid" class="form-control">
                    <option value="">全部</option>
                @foreach($menu_cates as $menu_cate)
                    <option value="{{ $menu_cate->id }}">{{ $menu_cate->name }}</option>
                @endforeach
                </select>
            </li>
            <li role="presentation" >
                <input type="text" name="keyword" class="form-control" placeholder="搜索菜品">
            </li>
            <li role="presentation" >
                <input type="text" name="min" class="form-control" placeholder="最小价格">
            </li>
            <li role="presentation" >
                <input type="text" name="max" class="form-control" placeholder="最大价格">
            </li>
            <li role="presentation" >
                <button type="submit" class="btn btn-default">搜索</button>
            </li>
        </ul>
        </form>
        <tr>
            <th>菜品名称</th>
            <th>菜品所属</th>
            <th>菜品图片</th>
            <th>上架状态</th>
            <th>菜品操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->goods_name }}</td>
                <td>{{ $menu->menu_cate->name }}</td>
                <td><img src="{{ $menu->goods_img}}"></td>
                <td>
                    @if($menu->status==1)
                        <a  class="btn btn-success">已上架</a>
                    @else
                        <a  class="btn btn-default">未上架</a>
                    @endif
                </td>
                <td>
                    @if($menu->status==1)
                        <a href="{{ route('menus.status',[$menu]) }}" class="btn btn-danger">下架</a>
                    @else
                        <a href="{{ route('menus.status',[$menu]) }}" class="btn btn-success">上架</a>
                    @endif
                    <a href="{{ route('menus.show',[$menu]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('menus.edit',[$menu])}}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('menus.destroy',[$menu]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
    {{ $menus->appends(['keyword'=>$keyword],['min'=>$min],['max'=>$max],['menucateid'=>$menucateid])->links() }}
    @stop