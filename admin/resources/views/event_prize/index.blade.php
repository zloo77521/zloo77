@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>奖品名称</th>
            <th>归属活动</th>
            <th>奖品详情</th>
            <th>活动操作</th>
        </tr>
        @foreach($event_prizes as $event_prize)
            <tr>
                <td>{{ $event_prize->name }}</td>
                <td>{{ $event_prize->events->title }}</td>
                <td>{{ $event_prize->description }}</td>
                <td><a href="{{ route('event_prizes.show',[$event_prize]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('event_prizes.edit',[$event_prize]) }}" class="btn btn-warning">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('event_prizes.destroy',[$event_prize]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $event_prizes->appends(['keyword'=>$keyword])->links() }}
    @stop