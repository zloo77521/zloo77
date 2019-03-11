@extends('layout.app')

@section('contents')
    <h1>修改活动</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('activitys.update',[$activity]) }}" >
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" value="{{ $activity->title }}">
        </div>
        <div class="form-group">
            <label>活动内容</label>
            <input type="text" name="content" class="form-control" value="{!!$activity->content!!}">
        </div>
        <div class="form-group">
            <label>开始时间</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ str_replace(' ','T',$activity->start_time) }}">
        </div>
        <div class="form-group">
            <label>结束时间</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{str_replace(' ','T',$activity->end_time)}}">
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop