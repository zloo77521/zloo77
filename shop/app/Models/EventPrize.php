<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //绑定表
    public function users(){
        return $this->belongsTo(User::class,'member_id','id');
    }
}
