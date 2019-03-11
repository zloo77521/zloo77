<?php

namespace App\Models;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //安全字段
    protected $fillable = ['user_id','goods_id','amount'];
    //绑定商品分类
    public function menus(){
        return $this->belongsTo(Menu::class,'goods_id');
    }
}
