<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name');
            $table->string('description');
            $table->string('tips');
            $table->string('goods_img');
            $table->integer('category_id');
            $table->integer('month_sales');
            $table->integer('rating_count');
            $table->integer('satisfy_count');
            $table->integer('shop_id');
            $table->integer('status');
            $table->float('rating',8,2);
            $table->float('goods_price',8,2);
            $table->float('satisfy_rate',8,2);
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
        Schema::dropIfExists('menus');
    }
}
