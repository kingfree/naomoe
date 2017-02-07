<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_characters', function (Blueprint $table) {
            $table->integer('pool_id')->unsigned()->nullable();
            $table->foreign('pool_id')->references('id')
                ->on('pools')->onDelete('cascade');

            $table->integer('character_id')->unsigned()->nullable();
            $table->foreign('character_id')->references('id')
                ->on('characters')->onDelete('cascade');

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
        Schema::dropIfExists('pool_characters');
    }
}
