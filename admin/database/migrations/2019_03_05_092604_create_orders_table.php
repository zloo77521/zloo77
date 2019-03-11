<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code');
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->string('provence');
            $table->string('city');
            $table->string('area');
            $table->string('detail_address');
            $table->decimal('order_price',8,2);
            $table->integer('order_status');
            $table->dateTime('order_birth_time');
            $table->string('out_trade_no');
            $table->string('tel');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
