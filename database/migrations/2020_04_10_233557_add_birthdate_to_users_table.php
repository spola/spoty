<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBirthdateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthdate')->nullable();
        });
        Schema::table('news', function (Blueprint $table) {
            $table->enum('type', array('news','birthday','activity'))->default('news');

            $table->string('entity')->nullable();
            $table->bigIncrements('entity_id')->nullable();

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
            $table->dropColumn('birthdate');
        });
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('entity');
            $table->dropColumn('entity_id');
        });
    }
}
