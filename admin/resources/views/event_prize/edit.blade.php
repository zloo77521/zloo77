@extends('layout.app')

@section('contents')
    <h1>修改奖品</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('event_prizes.update',[$EventPrize]) }}" >
        <div class="form-group">
            <label>奖品名称</label>
            <input type="text" name="name" class="form-control" value="{{ $EventPrize->name }}">
        </div>
        <div class="form-group">
            <label>奖品详情</label>
            <input type="text" name="description" class="form-control" value="{{ $EventPrize->description }}">
        </div>
        <div class="form-group">
            <label>所属活动</label>
            <select name="events_id">
                <option value="">抽奖活动</option>
                @foreach($events as $event)
                    <option value="{{$event->id}}" @if($event->id ==$EventPrize->events_id) selected @endif>{{$event->title}}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop