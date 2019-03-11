@extends('layout.app')

@section('contents')
    <h1>重置商家密码</h1>
    @include('layout._errors')

    <form method="post" action="{{ route('shops.update',[$User]) }}">
        <p>商家账号:{{ $User->name }}</p>
        <div class="form-group">
            <label>新密码</label>
            <input type="text" name="password" class="form-control">
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop