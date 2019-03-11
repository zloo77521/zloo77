@extends('layout.app')

@section('contents')
    <h1>会员详情</h1>
    <hr/>
    @include('layout._errors')
        <div class="form-group">
            <label>会员账号:{{ $member->username }}</label>
        </div>
    <hr/>
        <div class="form-group">
            <label>会员编号:{{ $member->id }}</label>
        </div>
    <hr/>
        <div class="form-group">
            <label>会员电话:{{ $member->tel }}</label>
        </div>
    <hr/>
    @stop