@extends('layout.app')

@section('contents')
    <h1>活动详情</h1>
    @include('layout._errors')
    <ul class="list-group">
        <li class="list-group-item">活动名称：{{ $activity->title }}</li>
        <li class="list-group-item">活动内容：{!!$activity->content!!}</li>
        <li class="list-group-item">开始时间：{{ $activity->start_time }}</li>
        <li class="list-group-item">结束时间：{{ $activity->end_time }}</li>
    </ul>
    @stop