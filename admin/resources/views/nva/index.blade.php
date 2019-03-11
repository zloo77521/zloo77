@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>页面名称</th>
            <th>页面地址</th>
            <th>顶级页面</th>
            <th>页面操作</th>
        </tr>
        @foreach($nvas as $nva)
            <tr>
                <td>{{ $nva->name }}</td>
                <td>{{$nva->url}}</td>
                <td>
                @if($nva->pid == 0)顶级页面@endif
                @foreach($Dmenus as $Dmenu)
                @if($nva->pid==$Dmenu->id){{$Dmenu->name}} @endif
                @endforeach
                </td>
                <td><a href="{{ route('nvas.edit',[$nva]) }}" class="btn btn-info">编辑</a>
                    <form style="display: inline" method="post" action="{{ route('nvas.destroy',[$nva]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $nvas->appends(['keyword'=>$keyword])->links() }}
    @stop