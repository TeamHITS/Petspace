<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenTextFieldToPetspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petspaces', function (Blueprint $table) {
            $table->string('open_text', 191)->after('delivery_fee')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petspaces', function (Blueprint $table) {
            $table->dropColumn(['open_text']);
        });
    }
}
