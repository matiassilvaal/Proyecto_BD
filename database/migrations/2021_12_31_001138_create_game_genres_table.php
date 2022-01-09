<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_genres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_juego')->nullable();
            $table->foreign('id_juego')->references('id')->on('games');
            $table->unsignedBigInteger('id_genero')->nullable();
            $table->foreign('id_genero')->references('id')->on('genres');
            $table->boolean('soft');
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
        Schema::dropIfExists('game_genres');
    }
}
