@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>店铺名称</th>
            <th>商家账号</th>
            <th>商品图片</th>
            <th>商家状态——操作</th>
            <th>店铺状态——操作</th>
            <th>店铺操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->shop->shop_name }}</td>
                <td>{{ $user->name }}</td>
                <td><img src="{{ $user->shop->shop_img}}"></td>
                <td>
                    @if($user->status==1)
                        <a  class="btn btn-success">正常</a>
                    @else
                        <a  class="btn btn-default">禁用</a>
                    @endif——
                    @if($user->status==1)
                        <a href="{{ route('shops.statuss',[$user]) }}" class="btn btn-danger">禁用</a>
                    @else
                        <a href="{{ route('shops.statuss',[$user]) }}" class="btn btn-success">启用</a>
                    @endif
                </td>
                <td>
                    @if($user->shop->status==1)
                        <a  class="btn btn-success">正常</a>
                    @else
                        <a  class="btn btn-default">禁用</a>
                    @endif——
                @if($user->shop->status==1)
                        <a href="{{ route('shops.status',[$user]) }}" class="btn btn-danger">禁用</a>
                @else
                        <a href="{{ route('shops.status',[$user]) }}" class="btn btn-success">启用</a>
                @endif
                </td>
                <td>
                    <a href="{{ route('users.show',[$user]) }}" class="btn btn-info">查看详细</a>
                    <a href="{{ route('users.edit',[$user]) }}" class="btn btn-warning">重置密码</a>
                    <form style="display: inline" method="post" action="{{ route('users.destroy',[$user]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
    {{ $users->appends(['keyword'=>$keyword])->links() }}
    @stop