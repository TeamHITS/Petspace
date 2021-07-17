<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPetsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pets', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id');
            $table->string('name', 151);
            $table->increments('type');
            $table->increments('gender');
            $table->string('breed', 191);
            $table->string('weight', 191);
            $table->string('color', 151);
            $table->string('chip_id_num', 191);
            $table->string('image', 191);
            $table->date('birthdate');
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
        Schema::drop('user_pets');
    }
}
