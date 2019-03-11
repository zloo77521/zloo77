<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','provence','city','area','detail_address','name','tel',
        'order_code','order_birth_time','order_price','out_trade_no','shop_id','order_status'];
}
