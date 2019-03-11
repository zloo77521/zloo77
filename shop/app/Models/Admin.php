<?php

namespace App\Models;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //安全字段
    protected $fillable = ['name','img','password'];
    //获取图片方法
    public function img()
    {
        return $this->img?Storage::url($this->img):'/image/head.jpg';
    }
}
