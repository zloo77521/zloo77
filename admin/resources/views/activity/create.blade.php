@extends('layout.app')

@section('contents')
    @include('vendor.ueditor.assets')
    <h1>发布活动</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('activitys.store') }}" >
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>开始时间</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time') }}">
        </div>
        <div class="form-group">
            <label>结束时间</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time') }}">
        </div>
        <div class="form-group">
            <label>活动内容</label>
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain"></script>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">发布</button>
    </form>
    @stop