<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LogAuditoria;
use Illuminate\Http\Request;

class LogAuditoriaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Capturamos la respuesta
        $response = $next($request);

        try {
            LogAuditoria::create([
                'ip' => $request->ip(),
                'fecha' => now(),
                'endpoint' => $request->fullUrl(),
                'rol_id' => auth()->check() ? auth()->user()->rol : null,
                'method' => $request->method(),
                'id_user' => auth()->check() ? (string)auth()->id() : null
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al registrar auditoría: ' . $e->getMessage());
        }

        return $response;
    }
}