@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>管理员编号</th>
            <th>管理员名称</th>
            <th>管理员头像</th>
            <th>管理员操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td><img src="{{ $admin->img}}"></td>
                <td><a href="{{ route('admins.edit',[$admin]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('admins.destroy',[$admin]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $admins->appends(['keyword'=>$keyword])->links() }}
    @stop