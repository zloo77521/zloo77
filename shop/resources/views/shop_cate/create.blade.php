@extends('layout.app')

@section('contents')
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <h1>添加分类</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('shop_cates.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <div id="uploader-demo">
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    <script>
    var uploader = WebUploader.create({
    // 选完文件后，是否自动上传。
    auto: true,
    // swf文件路径
    // swf: '/js/Uploader.swf',
    // 文件接收服务端。
    server: '',
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',

    // 只允许选择图片文件。
    accept: {
    title: 'Images',
    extensions: 'gif,jpg,jpeg,bmp,png',
    mimeTypes: 'image/*'
    },
    //设置上传气你去参数
        formData:{
        _token:'{{csrf_token()}}'
        }
    });
    </script>
    @stop