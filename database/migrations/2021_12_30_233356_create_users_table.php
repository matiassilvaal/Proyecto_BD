<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_direccion')->nullable();
            $table->foreign('id_direccion')->references('id')->on('addresses');
            $table->unsignedBigInteger('id_rol')->nullable();
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->unsignedBigInteger('id_moneda')->nullable();
            $table->foreign('id_moneda')->references('id')->on('currencies');
            $table->unsignedBigInteger('id_billetera')->nullable();
            $table->foreign('id_billetera')->references('id')->on('wallets');
            $table->string('nombre', 200)->unique();
            $table->date('fecha_de_nacimiento');
            $table->integer('moneda');
            $table->string('correo', 200)->unique();
            $table->string('contrasena', 20);
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
        Schema::dropIfExists('users');
    }
}
