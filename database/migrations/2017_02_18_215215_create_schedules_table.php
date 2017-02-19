<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year')->unsigend();
            $table->integer('month')->unsigend();
            $table->integer('day')->unsigend();
            $table->integer('competition_id')->unsigned()->nullable();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->boolean('visible')->default(true);
            $table->json('info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
