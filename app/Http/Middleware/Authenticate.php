<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Verifica si la solicitud espera una respuesta JSON (en el caso de las APIs)
        if (! $request->expectsJson()) {
            // Si no es una solicitud JSON, devuelve un error de autenticación sin redirigir
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
