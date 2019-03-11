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
                <td><a href="{{ route('event_members.show',[$event]) }}" class="btn btn-info">查看报名人数</a>
                </td>
            </tr>
            @endforeach
    </table>
    {{ $events->appends(['keyword'=>$keyword])->links() }}
    @stop