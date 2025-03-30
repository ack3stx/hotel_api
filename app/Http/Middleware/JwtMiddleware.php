<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
            // Verificar si el usuario está baneado/deshabilitado
            if ($user->estado === 'inactivo' || $user->estado === 'ban') {
                // Invalidar explícitamente el token
                JWTAuth::invalidate(JWTAuth::getToken());
                
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tu cuenta ha sido deshabilitada. Contacta al administrador.'
                ], 403);
            }
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token inválido'
                ], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token expirado'
                ], 401);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token no encontrado'
                ], 401);
            }
        }
        
        return $next($request);
    }
}