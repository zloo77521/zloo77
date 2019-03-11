@extends('layout.app')

@section('contents')
    <h1>中奖名单</h1>
    @include('layout._errors')
    <form method="post">
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label>中奖名单如下：</label>
            @foreach($event_prizes as $event_prize)
            <input type="text" name="details" class="form-control" value="{{ $event_prize->users->name }}获得:{{$event_prize->name}}">
             @endforeach
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
    </form>
    @stop