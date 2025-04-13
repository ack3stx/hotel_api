<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('rol');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('codigo_verificacion')->nullable();
            $table->string('estado');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insertar usuario administrador
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'rol' => '2',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
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
};