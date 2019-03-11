@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>分类编号</th>
            <th>分类名称</th>
            <th>分类状态</th>
            <th>分类操作</th>
        </tr>
        @foreach($menu_cates as $menu_cate)
            <tr>
                <td>{{ $menu_cate->id }}</td>
                <td>{{ $menu_cate->name }}</td>
                <td>
                    @if($menu_cate->is_selected==1)
                        <a  class="btn btn-success">默认</a>
                    @else
                        <a  class="btn btn-default">普通</a>
                    @endif
                </td>
                <td>
                    @if($menu_cate->is_selected==0)
                        <a href="{{ route('menu_cates.status',[$menu_cate]) }}" class="btn btn-success">默认</a>
                    @endif
                    <a href="{{ route('menu_cates.edit',[$menu_cate]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('menu_cates.destroy',[$menu_cate])}}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $menu_cates->appends(['keyword'=>$keyword])->links() }}
    @stop