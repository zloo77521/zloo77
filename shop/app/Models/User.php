<?php

namespace App\Models;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //安全字段
    protected $fillable = ['name','password','shop_id','status','email','img'];
    //绑定店铺
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function img()
    {
        return $this->img?Storage::url($this->img):'/image/head.jpg';
    }
}
