<?php

use App\Http\Controllers\controlador_gael;
use App\Http\Controllers\controlador_bd;
use App\Http\Controllers\User_Tara_Controller;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ReservacionesController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\HuespedController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\AuditoriaController;

// Rutas públicas (sin autenticación)
Route::post('v1/login', [UserController::class, 'login']);
Route::post('v1/register', [UserController::class, 'register']);
Route::post('v1/verificar', [UserController::class, 'verifyEmail']);

// Rutas de Usuario
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/desabilitar', [UserController::class, 'desabilitarUsuario']);
        Route::post('v1/activar', [UserController::class, 'activar_usuario']);
    });
    
    // Ruta para administradores y usuarios normales
    Route::get('v1/users', [UserController::class, 'mostrarUsuarios']);
});

// Rutas de Reservación
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas GET para todos los roles
    Route::get('v1/Reservacion/{id?}/', [ReservacionesController::class, 'mostrarReservacion']);
    Route::get('v1/Reservacion/usuario', [ReservacionesController::class, 'reservacionUsuario']);


    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Reservacion', [ReservacionesController::class, 'nuevaReservacion']);
        Route::put('v1/Reservacion/{id}', [ReservacionesController::class, 'actualizarReservacion']);
        Route::delete('v1/Reservacion/{id}', [ReservacionesController::class, 'eliminarReservacion']);
        Route::put('v1/Reservacion/cancelar/{id}', [ReservacionesController::class, 'cancelarReservacion']);
    });
});

// Rutas de Factura
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas GET para todos los roles
    Route::get('v1/Factura/{id?}', [FacturasController::class, 'mostrarFacturas']);
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Factura', [FacturasController::class, 'nuevaFactura']);
        Route::put('v1/Factura/{id}', [FacturasController::class, 'actualizarFactura']);
        Route::delete('v1/Factura/{id}', [FacturasController::class, 'eliminarFactura']);
    });
});

// Rutas de Habitación
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas GET para todos los roles
    Route::get('v1/Habitacion', [HabitacionController::class, 'mostrarHabitaciones']);
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Habitacion', [HabitacionController::class, 'nuevaHabitacion']);
        Route::put('v1/Habitacion/{id}', [HabitacionController::class, 'actualizarHabitacion']);
        Route::delete('v1/Habitacion/{id}', [HabitacionController::class, 'eliminarHabitacion']);
    });
});

// Rutas de Huésped
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas GET para todos los roles
    Route::get('v1/Huesped', [HuespedController::class, 'mostrarHuespedes']);
    Route::get('v1/Huesped/actual', [HuespedController::class, 'getHuespedActual']);
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Huesped', [HuespedController::class, 'nuevoHuesped']);
        Route::put('v1/Huesped/{id}', [HuespedController::class, 'actualizarHuesped']);
        Route::delete('v1/Huesped/{id}', [HuespedController::class, 'eliminarHuesped']);
    });
});

// Rutas de Mantenimiento
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas GET para todos los roles
    Route::get('v1/Mantenimiento', [MantenimientoController::class, 'mostrarMantenimientos']);
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Mantenimiento', [MantenimientoController::class, 'nuevoMantenimiento']);
        Route::put('v1/Mantenimiento/{id}', [MantenimientoController::class, 'actualizarMantenimiento']);
        Route::delete('v1/Mantenimiento/{id}', [MantenimientoController::class, 'eliminarMantenimiento']);
    });
});

// Rutas de Empleado
Route::middleware(['auth.jwt', 'auditoria'])->group(function () {
    // Rutas GET para todos los roles
    Route::get('v1/Empleados', [EmpleadoController::class, 'mostrarEmpleados']);
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Empleado', [EmpleadoController::class, 'nuevoEmpleado']);
        Route::put('v1/Empleado/{id}', [EmpleadoController::class, 'actualizarEmpleado']);
        Route::delete('v1/Empleado/{id}', [EmpleadoController::class, 'eliminarEmpleado']);
    });
});


// Rutas de auditoría - solo auth.jwt sin middleware de auditoria
Route::middleware(['auth.jwt'])->group(function () {
    Route::get('v1/auditoria', [AuditoriaController::class, 'index']);
    Route::get('v1/auditoria/{id}', [AuditoriaController::class, 'show']);
    Route::get('v1/auditoria/estadisticas/usuarios', [AuditoriaController::class, 'estadisticasPorUsuario']);
});