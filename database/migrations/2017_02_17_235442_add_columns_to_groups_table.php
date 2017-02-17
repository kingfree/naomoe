<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->integer('win')->default(1);
        });
        Schema::table('options', function (Blueprint $table) {
            $table->integer('winner')->default(0);
            $table->json('data')->nullable();
        });
        Schema::table('vote_logs', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('win');
        });
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('winner');
            $table->dropColumn('data');
        });
        Schema::table('vote_logs', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('province');
            $table->dropColumn('city');
        });
    }
}
