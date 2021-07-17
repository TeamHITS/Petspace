<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmenuListsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenu_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->increments('cat_service_id');
            $table->string('name', 191);
            $table->text('decription', 65535);
            $table->increments('condition_option');
            $table->increments('select_count');
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
        Schema::drop('submenu_lists');
    }
}
