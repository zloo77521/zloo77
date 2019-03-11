@extends('layout.app')

@section('contents')
    <table class="table table-bordered">

    <tr>
            <th>活动名称</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>查看详情</th>
    </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{ $activity->title }}</td>
                <td>{!!$activity->content!!}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td><a href="{{ route('activitys.show',[$activity]) }}" class="btn btn-info">查看</a></td>
            </tr>
            @endforeach
    </table>
    @stop