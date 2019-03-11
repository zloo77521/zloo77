@extends('layout.app')

@section('contents')
    <h1>注册商家</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('shops.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>用户帐号</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>用户密码</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>用户邮箱</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>用户头像</label>
            <input type="file" name="img" >
        </div>
        <hr/>
        <div class="form-group">
            <label>店铺名称</label>
            <input type="text" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
        </div>
        <div class="form-group">
            <label>店铺图片</label>
            <input type="file" name="shop_img" >
        </div>
        <div class="form-group">
            <label>商加所属分类</label>
            <select name="shop_cate_id" class="form-control">
                @foreach($shop_cates as $shop_cate)
                    <option value="{{ $shop_cate->id }}"
                            @if(old('shop_cate_id')==$shop_cate->id) selected @endif
                    >{{ $shop_cate->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>是否是品牌  </label>
            <label class="radio-inline">
                <input type="radio" name="brand" id="inlineRadio1" value="1"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="brand" id="inlineRadio2" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否准时送达</label>
            <label class="radio-inline">
                <input type="radio" name="on_time" id="inlineRadio1" value="1"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="on_time" id="inlineRadio2" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送</label>
            <label class="radio-inline">
                <input type="radio" name="fengniao" id="inlineRadio1" value="1"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="fengniao" id="inlineRadio2" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否保标记  </label>
            <label class="radio-inline">
                <input type="radio" name="bao" id="inlineRadio1" value="1"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="bao" id="inlineRadio2" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否票标记  </label>
            <label class="radio-inline">
                <input type="radio" name="piao" id="inlineRadio1" value="1"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="piao" id="inlineRadio2" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>是否准标记  </label>
            <label class="radio-inline">
                <input type="radio" name="zhun" id="inlineRadio1" value="1"> 是
            </label>
            <label class="radio-inline">
                <input type="radio" name="zhun" id="inlineRadio2" value="0"> 否
            </label>
        </div>
        <div class="form-group">
            <label>起送金额</label>
            <input type="text" name="start_send" class="form-control" value="{{ old('start_send') }}">
        </div>
        <div class="form-group">
            <label>配送费</label>
            <input type="text" name="send_cost" class="form-control" value="{{ old('send_cost') }}">
        </div>
        <div class="form-group">
            <label>店铺公告</label>
            <input type="text" name="notice" class="form-control" value="{{ old('notice') }}">
        </div>
        <div class="form-group">
            <label>优惠信息</label>
            <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
        </div>

        <div class="form-group">
            <label>验证码</label>
            <input type="text" name="captcha" class="form-control">
            <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">提交</button>
    </form>
    @stop