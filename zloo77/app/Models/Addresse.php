<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
    //安全字段
    protected $fillable = ['user_id','provence','city','area','detail_address','tel','name','is_default'];
}
