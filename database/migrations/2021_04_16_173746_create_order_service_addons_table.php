<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderServiceAddonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_service_addons', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('order_service_id');
            $table->increments('submenu_service_id');
            $table->float('price');
            $table->datetime('deleted_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_service_addons');
    }
}
