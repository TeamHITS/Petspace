<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id');
            $table->string('ref', 191);
            $table->string('type', 191);
            $table->increments('first_digits');
            $table->increments('last_digits');
            $table->string('country', 50);
            $table->increments('expire_month');
            $table->increments('expire_year');
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
        Schema::drop('user_cards');
    }
}
