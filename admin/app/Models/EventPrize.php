<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //安全字段
    protected $fillable = ['events_id','name','description','member_id'];
    //绑定抽奖表
    public function events(){
        return $this->belongsTo(Event::class,'events_id','id');
    }
    //绑定抽奖表
    public function users(){
        return $this->belongsTo(User::class,'member_id','id');
    }
}
