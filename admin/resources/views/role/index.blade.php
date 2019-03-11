@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>权限编号</th>
            <th>权限名称</th>
            <th>活动操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{$role->name}}</td>
                <td><a href="{{ route('roles.edit',[$role]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('roles.destroy',[$role]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    @stop