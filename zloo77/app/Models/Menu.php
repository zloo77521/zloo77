<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    //安全字段
    protected $fillable = ['goods_name','description','tips','goods_img','category_id','month_sales','rating_count',
        'satisfy_count','shop_id','status','rating','goods_price','satisfy_rate'];
    //获取图片方法
    public function menu_img()
    {
        return $this->menu_img?Storage::url($this->menu_img):'/image/head.jpg';
    }
    //绑定菜品分类
    public function menu_cate(){
        return $this->belongsTo(MenuCate::class,'category_id');
    }
}
