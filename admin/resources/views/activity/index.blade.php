@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <form class="navbar-form navbar-left" action="{{ route('activitys.index') }}">
            <ul class="nav nav-pills">
                <li role="presentation" >
                    <select name="keyword" class="form-control">
                        <option value="">全部</option>
                        <option value="1">未开始</option>
                        <option value="2">进行中</option>
                        <option value="3">已结束</option>
                    </select>
                </li>
                <li role="presentation" >
                    <button type="submit" class="btn btn-default">搜索</button>
                </li>
            </ul>
        </form>
        <tr>
            <th>活动名称</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>活动操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{ $activity->title }}</td>
                <td>{!!$activity->content!!}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td><a href="{{ route('activitys.edit',[$activity]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('activitys.destroy',[$activity]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $activitys->appends(['keyword'=>$keyword])->links() }}
    @stop