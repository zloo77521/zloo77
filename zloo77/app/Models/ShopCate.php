<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ShopCate extends Model
{
    //安全字段
    protected $fillable = ['name','img','status'];
    //设置图片调用方法
    public function img()
    {
        return $this->img?Storage::url($this->img):'/image/head.jpg';
    }
}
