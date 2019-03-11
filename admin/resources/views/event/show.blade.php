@extends('layout.app')

@section('contents')
    <h1>抽奖详情</h1>
    @include('layout._errors')
    <form method="post">
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label>开始时间</label>
            <input type="datetime-local" name="signup_start" class="form-control" value="{{ str_replace(' ','T',$event->signup_start) }}">
        </div>
        <div class="form-group">
            <label>结束时间</label>
            <input type="datetime-local" name="signup_end" class="form-control" value="{{str_replace(' ','T',$event->signup_end)}}">
        </div>
        <div class="form-group">
            <label>人数上限</label>
            <input type="number" min="1" max="5" name="signup_num" value="{{ $event->signup_num }}"/>
        </div>
        <div class="form-group">
            <label>活动内容</label>
            <input type="text" name="details" class="form-control" value="{!!$event->details!!}">
        </div>
        @if($event->is_prize == 1)
        <a href="{{route('event.status',[$event] )}}" class="btn btn-info">开始抽奖</a>
        @else
         <a href="{{route('event.result',[$event] )}}" class="btn btn-info">查看结果</a>
        @endif
        {{ csrf_field() }}
        {{ method_field('patch') }}
    </form>
    @stop