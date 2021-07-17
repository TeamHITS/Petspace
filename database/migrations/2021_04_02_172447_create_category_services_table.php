<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryServicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_services', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('category_id');
            $table->string('name', 191);
            $table->text('description', 65535);
            $table->float('price');
            $table->float('discount');
            $table->string('service_duration', 191);
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
        Schema::drop('category_services');
    }
}
