<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return response()->json(['message' => 'No autorizado'], 401);
        }

        $user = auth()->user();

        // Verificar si el usuario tiene un rol permitido
        if (!in_array($user->rol, $roles)) {
            // Si el usuario tiene rol 3 y es una petición GET, permitir
            if ($user->rol === '3' && $request->isMethod('GET')) {
                return $next($request);
            }

            return response()->json(['message' => 'No tiene permisos para esta operación'], 403);
        }

        return $next($request);
    }
}