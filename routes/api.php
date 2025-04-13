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
use Illuminate\Support\Facades\Broadcast;
use App\Http\Middleware\JwtMiddleware;



// Rutas públicas (sin autenticación)
Route::post('v1/login', [UserController::class, 'login']);
Route::post('v1/register', [UserController::class, 'register']);
Route::post('v1/verificar', [UserController::class, 'verifyEmail']);
Route::post( 'v1/reenviar', [UserController::class, 'renviarcodigo']);
Route::post('v1/solicitar-nuevo-token', [UserController::class, 'solicitarNuevoToken']);
Route::post('v1/newToken',[UserController::class, 'refreshToken']);



Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    Route::get('v1/userinfo', [UserController::class, 'VerificarCuenta']);
});

// Rutas de Usuario
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/users/{id?}', [UserController::class, 'mostrarUsuarios']);
    });

    
    // Rutas sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/desabilitar', [UserController::class, 'desabilitarUsuario']);
        Route::post('v1/activar', [UserController::class, 'activar_usuario']);
        Route::post('v1/cambiarrol/{id}', [UserController::class, 'darroluser']);
        Route::post('v1/quitarrol/{id}',[UserController::class, 'cambiarroluser']);
        Route::put('v1/users/{id}', [UserController::class, 'actualizarUser']);
        Route::post('v1/guestrol/{id}', [UserController::class, 'darrolguest']);
    });
});

// Rutas de Reservación
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/Reservacion/{id?}/', [ReservacionesController::class, 'mostrarReservacion']);
        Route::get('v1/Reservacion/usuario', [ReservacionesController::class, 'reservacionUsuario']);
    });

    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Reservacion', [ReservacionesController::class, 'nuevaReservacion']);
        Route::put('v1/Reservacion/{id}', [ReservacionesController::class, 'actualizarReservacion']);
        Route::delete('v1/Reservacion/{id}', [ReservacionesController::class, 'eliminarReservacion']);
        Route::put('v1/Reservacion/cancelar/{id}', [ReservacionesController::class, 'cancelarReservacion']);
    });
});

// Rutas de Factura
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/Factura/{id?}', [FacturasController::class, 'mostrarFacturas']);
    });
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Factura', [FacturasController::class, 'nuevaFactura']);
        Route::put('v1/Factura/{id}', [FacturasController::class, 'actualizarFactura']);
        Route::delete('v1/Factura/{id}', [FacturasController::class, 'eliminarFactura']);
    });
});

// Rutas de Habitación
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/Habitacion', [HabitacionController::class, 'mostrarHabitaciones']);
    });
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Habitacion', [HabitacionController::class, 'nuevaHabitacion']);
        Route::put('v1/Habitacion/{id}', [HabitacionController::class, 'actualizarHabitacion']);
        Route::delete('v1/Habitacion/{id}', [HabitacionController::class, 'eliminarHabitacion']);
    });
});

// Rutas de Huésped
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/Huesped/{id?}', [HuespedController::class, 'mostrarHuespedes']);
        Route::get('v1/Huesped/actual', [HuespedController::class, 'getHuespedActual']);
    });
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Huesped', [HuespedController::class, 'nuevoHuesped']);
        Route::put('v1/Huesped/{id}', [HuespedController::class, 'actualizarHuesped']);
        Route::delete('v1/Huesped/{id}', [HuespedController::class, 'eliminarHuesped']);
    });
});

// Rutas de Mantenimiento
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/Mantenimiento/{id?}', [MantenimientoController::class, 'mostrarMantenimientos']);
    });
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Mantenimiento', [MantenimientoController::class, 'nuevoMantenimiento']);
        Route::put('v1/Mantenimiento/{id}', [MantenimientoController::class, 'actualizarMantenimiento']);
        Route::delete('v1/Mantenimiento/{id}', [MantenimientoController::class, 'eliminarMantenimiento']);
    });
});

// Rutas de Empleado
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Rutas GET para todos los roles (con auditoría)
    Route::middleware(['auditoria.consulta'])->group(function () {
        Route::get('v1/Empleados', [EmpleadoController::class, 'mostrarEmpleados']);
    });
    
    // Rutas POST/PUT/DELETE sólo para administradores
    Route::middleware(['rol:2'])->group(function () {
        Route::post('v1/Empleado', [EmpleadoController::class, 'nuevoEmpleado']);
        Route::put('v1/Empleado/{id}', [EmpleadoController::class, 'actualizarEmpleado']);
        Route::delete('v1/Empleado/{id}', [EmpleadoController::class, 'eliminarEmpleado']);
    });
});

// Rutas de auditoría (con su propio registro de auditoría)
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    Route::get('v1/auditoria', [AuditoriaController::class, 'index']);
    Route::get('v1/auditoria/estadisticas/usuarios', [AuditoriaController::class, 'estadisticasPorUsuario']);
});

//websockets
Broadcast::routes(['middleware' => ['auth:api']]);

// Ruta para SSE de Facturas (con auditoría)
Route::middleware(['auth.jwt', 'JwtMiddleware'])->group(function () {
    // Ruta para SSE de Facturas (con auditoría)
    Route::get('v1/Facturas/SSE', [FacturasController::class, 'facturaStream']);
});


