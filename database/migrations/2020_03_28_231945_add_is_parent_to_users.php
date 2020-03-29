<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsParentToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_parent')->default(false);
            \DB::statement('ALTER TABLE `users` CHANGE `grade_id` `grade_id` BIGINT(20) UNSIGNED NULL;');
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
            $table->dropColumn('is_parent');
            \DB::statement('ALTER TABLE `users` CHANGE `grade_id` `grade_id` BIGINT(20) UNSIGNED;');
        });
    }
}
