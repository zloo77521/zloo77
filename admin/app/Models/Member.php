<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     //安全字段
    protected $fillable = ['username','password','tel'];
}
