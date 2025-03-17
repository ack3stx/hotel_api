<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('huesped_id')->constrained('huespeds'); // Changed from id_huesped to huesped_id
            $table->foreignId('habitacion_id')->constrained('habitacions');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->decimal('precio_total', 8, 2);
            $table->string('estado_reservacion');
            $table->string('metodo_pago');
            $table->decimal('monto_pagado', 8, 2);
            $table->string('estado');
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
        Schema::dropIfExists('reservacions');
    }
};
