<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('user_id');
            $table->increments('petspace_id');
            $table->increments('status');
            $table->string('address', 191);
            $table->string('latitude', 191);
            $table->string('longitude', 191);
            $table->datetime('date_time');
            $table->float('rating');
            $table->float('delivery_fee');
            $table->float('total');
            $table->text('note', 65535);
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
        Schema::drop('orders');
    }
}
