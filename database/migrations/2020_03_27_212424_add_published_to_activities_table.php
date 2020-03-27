<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishedToActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->datetime('published')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->enum('type', array('file','video','link'))->default('file');

            $table->boolean('scored')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('published');
            $table->dropColumn('type');
            $table->dropColumn('scored');
        });
    }
}
