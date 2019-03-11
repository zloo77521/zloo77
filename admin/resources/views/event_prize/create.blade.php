@extends('layout.app')

@section('contents')
    @include('vendor.ueditor.assets')
    <h1>添加奖品</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('event_prizes.store') }}" >
        <div class="form-group">
            <label>奖品名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>奖品详情</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label>所属活动</label>
            <select name="events_id">
                <option value="">抽奖活动</option>
                @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->title}}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
    @stop