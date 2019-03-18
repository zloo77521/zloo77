@extends('layout.app')

@section('contents')
    <h1>{{ $Event->title}}</h1>
    @include('layout._errors')
        <div class="form-group">
            <label><h3>抽奖活动详情:</h3></label>
            {!! $Event->details!!} 报名时间：{{$Event->signup_start}}到{{$Event->signup_end}}结束。
                最高只能有{{$Event->signup_num}}人参加抽奖。

        </div>
    <?php
            $event_member = \App\Models\EventMember::where('events_id',$Event->id)->get();
    ?>
    @if(count($event_member) < $Event->signup_num)
        <a href="{{route('event_members.create',[$Event])}}"  class="btn btn-danger">立即报名</a>
    @else
        <a href="{{route('event_members.index')}}"  class="btn btn-warning">报名人数已满</a>
    @endif
        {{ csrf_field() }}
    @stop