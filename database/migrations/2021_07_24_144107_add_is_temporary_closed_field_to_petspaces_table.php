<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsTemporaryClosedFieldToPetspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petspaces', function (Blueprint $table) {
            $table->boolean('is_temporary_closed')->after('is_approved')->default('0');
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
            $table->dropColumn(['is_temporary_closed']);
        });
    }
}
