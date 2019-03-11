<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    //设置安全属性
    protected $fillable = ['shop_category_id','shop_name','shop_img','shop_rating','start_send','send_cost','brand',
        'on_time','fengniao','bao','piao','zhun','notice','discount','status'];
    //设置img方法
    public function img()
    {
        return $this->img?Storage::url($this->img):'/image/head.jpg';
    }
    //绑定商家分类
    public function shop_cates(){
        return $this->belongsTo(ShopCate::class);
    }
}
