<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //安全字段
    protected $fillable = ['title','details','signup_start','signup_end','prize_date','signup_num','is_prize'];
}
