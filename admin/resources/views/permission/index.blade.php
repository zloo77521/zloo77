@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>权限编号</th>
            <th>权限名称</th>
            <th>活动操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{$permission->name}}</td>
                <td><a href="{{ route('permissions.edit',[$permission]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('permissions.destroy',[$permission]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $permissions->appends(['keyword'=>$keyword])->links() }}

    @stop