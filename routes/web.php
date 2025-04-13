<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('activar-cuenta', function (Request $request) {
    if (!$request->hasValidSignature()) {
        abort(403, 'Enlace no válido o expirado.');
    }

    return view('auth.activar-cuenta', ['email' => $request->email]);
})->name('activar.cuenta');

// Ruta para procesar la activación
Route::post('verificar-codigo', [UserController::class, 'verificarCodigo'])->name('verificar.codigo');

// Vista para formulario de reenvío
Route::get('/reenviar-verificacion', function () {
    return view('auth.reenviar-verificacion');
})->name('reenviar.form');

// Añadir esta nueva ruta para procesar el formulario de reenvío
Route::post('/reenviar-codigo', [UserController::class, 'renviarcodigo'])->name('reenviar.codigo');