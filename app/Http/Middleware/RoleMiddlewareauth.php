<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddlewareauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->rol_id == 1) {
                return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);
            }
        } else {
            return response()->json(['error' => 'No estás autenticado'], 401);
        }

        return $next($request);
    }
}
