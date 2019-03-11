@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <form class="navbar-form navbar-left" role="search" action="{{ route('order.index') }}">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="收货人电话" name="keyword">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
        <tr>
            <th>订单编号</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>订单价格</th>
            <th>订单状态</th>
            <th>订单时间</th>
            <th>订单操作</th>

        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ strtotime($order->order_code) }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->order_price }}</td>
                <td>
                    @if($order->order_status==1)
                        <a  class="btn btn-success">已经完成</a>
                    @else
                        <a  class="btn btn-default">禁用</a>
                    @endif
                </td>
                <td>{{ $order->order_birth_time }}</td>
                <td><a href="{{ route('order.show',[$order]) }}" class="btn btn-info">查看</a>
                    @if($order->order_status==1)
                        <a href="{{ route('order.status',[$order]) }}" class="btn btn-danger">禁用</a>
                    @else
                        <a href="{{ route('order.status',[$order]) }}" class="btn btn-success">恢复</a>
                    @endif
                </td>
            </tr>
            @endforeach
    </table>
    {{ $orders->appends(['keyword'=>$keyword])->links() }}
    @stop