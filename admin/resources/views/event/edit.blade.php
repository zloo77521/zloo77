@extends('layout.app')

@section('contents')
    <h1>修改活动</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('events.update',[$event]) }}" >
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
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop