@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>活动名称</th>
            <th>抽奖时间</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>活动操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->prize_date }}</td>
                <td>{{ $event->signup_start }}</td>
                <td>{{ $event->signup_end }}</td>
                <td>
                    @if($event->is_prize == 0)
                    <a href="{{ route('event_members.result',[$event]) }}" class="btn btn-info">查看结果</a>
                    @else
                    <a href="{{ route('event_members.show',[$event]) }}" class="btn btn-danger">立即报名</a>
                    @endif


                </td>
            </tr>
            @endforeach
    </table>
    {{ $events->appends(['keyword'=>$keyword])->links() }}
    @stop