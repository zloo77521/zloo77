@extends('layout.app')

@section('contents')
    <h1>订单详情</h1>
    <hr/>
    @include('layout._errors')
        <div class="form-group">
            <label>订单编号:{{ strtotime($order->order_code) }}</label>
        </div>
    <hr/>
    <div class="form-group">
        <label>收货人姓名:{{ $order->name }}</label>
    </div>
    <hr/>
    <div class="form-group">
        <label>收货人电话:{{ $order->tel }}</label>
    </div>
    <hr/>
    <div class="form-group">
        <label>订单价格:{{ $order->order_price }}</label>
    </div>
    <hr/>
    <div class="form-group">
        <label>订货时间:{{ $order->order_birth_time }}</label>
    </div>
    <hr/>
    <div class="form-group">
        <label>收货人详细地址:{{ $order->provence.$order->city.$order->area.$order->detail_address }}</label>
    </div>
    @stop