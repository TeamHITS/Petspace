<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePetspaceTechniciansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petspace_technicians', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('user_id');
            $table->increments('petspace_id');
            $table->increments('status');
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
        Schema::drop('petspace_technicians');
    }
}
