<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cates', function (Blueprint $table) {
            $table->increments('goods_id');
            $table->string('name');
            $table->string('type_accumulation');
            $table->integer('shop_id');
            $table->string('description');
            $table->integer('is_selected');
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
        Schema::dropIfExists('menu_cates');
    }
}
