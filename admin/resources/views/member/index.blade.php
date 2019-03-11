@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <form class="navbar-form navbar-left" role="search" action="{{ route('member.index') }}">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="按会员账号搜索" name="keyword">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
        <tr>
            <th>会员编号</th>
            <th>会员账号</th>
            <th>会员状态</th>
            <th>会员操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>
                    @if($member->status==1)
                        <a  class="btn btn-success">正常</a>
                    @else
                        <a  class="btn btn-default">禁用</a>
                    @endif
                </td>
                <td><a href="{{ route('member.show',[$member]) }}" class="btn btn-info">查看</a>
                    @if($member->status==1)
                        <a href="{{ route('member.status',[$member]) }}" class="btn btn-danger">禁用</a>
                    @else
                        <a href="{{ route('member.status',[$member]) }}" class="btn btn-success">恢复</a>
                    @endif
                </td>
            </tr>
            @endforeach
    </table>
    {{ $members->appends(['keyword'=>$keyword])->links() }}
    @stop