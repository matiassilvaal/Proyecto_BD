<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_juego')->nullable();
            $table->foreign('id_juego')->references('id')->on('games');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('id_comment_type')->nullable();
            $table->foreign('id_comment_type')->references('id')->on('comment_types');
            $table->string('texto', 1000);
            $table->date('fecha_de_creacion');
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
        Schema::dropIfExists('comments');
    }
}
