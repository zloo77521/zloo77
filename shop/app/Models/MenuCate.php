<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCate extends Model
{
    //安全字段
    protected $fillable = ['name','type_accumulation','shop_id','description','is_selected'];
}
