<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_publisher')->nullable();
            $table->foreign('id_publisher')->references('id')->on('users');
            $table->unsignedBigInteger('id_requisito')->nullable();
            $table->foreign('id_requisito')->references('id')->on('requirements');
            $table->unsignedBigInteger('id_ubicacion')->nullable();
            $table->foreign('id_ubicacion')->references('id')->on('addresses');
            $table->unsignedBigInteger('id_restriccion')->nullable();
            $table->foreign('id_restriccion')->references('id')->on('age_restrictions');
            $table->integer('precio');
            $table->date('fecha_de_lanzamiento');
            $table->integer('descuento');
            $table->string('imagen', 500);
            $table->string('descripcion', 600);
			$table->string('descarga', 600);
			$table->string('demo', 600);
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
        Schema::dropIfExists('games');
    }
}
