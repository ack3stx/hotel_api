<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class GenerateToken
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $credentials = $request->only('email', 'password');

            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'Credenciales inválidas'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'No se pudo crear el token'], 500);
            }

            $data = $response->getData(true);
            $data['access_token'] = $token;
            $data['token_type'] = 'bearer';
            $data['expires_in'] = JWTAuth::factory()->getTTL() * 60;

            $response->setData($data);
        }

        return $response;
    }
}