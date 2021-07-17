<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePetspacesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petspaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->increments('grooming');
            $table->boolean('is_delivery_fee');
            $table->boolean('is_pick_drop_available');
            $table->float('delivery_fee');
            $table->float('rating');
            $table->string('latitude', 191);
            $table->string('longitude', 191);
            $table->string('image', 191);
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
        Schema::drop('petspaces');
    }
}
