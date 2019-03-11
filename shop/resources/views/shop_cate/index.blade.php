@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>分类编号</th>
            <th>分类名称</th>
            <th>分类图标</th>
            <th>分类操作</th>
        </tr>
        @foreach($shop_cates as $shop_cate)
            <tr>
                <td>{{ $shop_cate->id }}</td>
                <td>{{ $shop_cate->name }}</td>
                <td><img src="{{ $shop_cate->img}}"></td>
                <td><a href="{{ route('shop_cates.edit',[$shop_cate]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('shop_cates.destroy',[$shop_cate])}}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $shop_cates->appends(['keyword'=>$keyword])->links() }}
    @stop