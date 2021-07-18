<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidatorFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->boolean('is_profile_completed')->after('email')->default('0');
             $table->boolean('is_address_added')->after('is_profile_completed')->default('0');
             $table->boolean('is_pet_added')->after('is_address_completed')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_profile_completed','is_address_added', 'is_pet_added']);
        });
    }
}