<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('id_juego')->nullable();
            $table->foreign('id_juego')->references('id')->on('games');
			$table->unsignedBigInteger('id_boleta')->nullable();
            $table->foreign('id_boleta')->references('id')->on('invoices');
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
        Schema::dropIfExists('purchases');
    }
}
