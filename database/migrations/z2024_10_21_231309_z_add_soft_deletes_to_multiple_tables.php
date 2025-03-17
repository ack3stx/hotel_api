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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('empleados', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('huespeds', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('habitacions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('reservacions', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('facturas', function (Blueprint $table) {
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('huespeds', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('habitacions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('reservacions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('facturas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

    }
};
