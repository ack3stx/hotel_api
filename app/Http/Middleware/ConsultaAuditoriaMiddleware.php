<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogAuditoria;

class ConsultaAuditoriaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Procesar la solicitud primero
        $response = $next($request);
        
        // Solo registrar si es método GET
        if ($request->method() === 'GET') {
            try {
                $user = auth()->user();
                
                LogAuditoria::create([
                    'usuario' => $user ? $user->name : 'Anónimo',
                    'accion' => 'Consultó',
                    'endpoint' => $this->formatEndpoint($request->fullUrl()),
                    'fecha' => now()->setTimezone('America/Mexico_City'),
                    'datos' => $this->extractResponseData($response)
                ]);
            } catch (\Exception $e) {
                \Log::error('Error al registrar auditoría: ' . $e->getMessage());
            }
        }
        
        return $response;
    }
    
    /**
     * Formatea el endpoint para hacerlo más legible
     */
    private function formatEndpoint($fullUrl)
    {
        // Extraer la parte de la URL después del dominio
        $parsedUrl = parse_url($fullUrl);
        $path = $parsedUrl['path'] ?? '';
        
        // Eliminar /api/ y v1/ si existen
        $cleanPath = str_replace(['/api/', 'v1/'], '', $path);
        
        // Agregar parámetros de consulta si existen
        if (isset($parsedUrl['query'])) {
            $cleanPath .= '?' . $parsedUrl['query'];
        }
        
        return $cleanPath;
    }
    
    /**
     * Intenta extraer datos de respuesta para auditoría
     */
    private function extractResponseData($response)
    {
        try {
            $content = $response->getContent();
            $data = json_decode($content, true);
            
            // Si es una respuesta JSON válida
            if (json_last_error() === JSON_ERROR_NONE) {
                // Si es una colección, guardar información resumida
                if (isset($data[0]) && is_array($data)) {
                    return ['tipo' => 'colección', 'total' => count($data), 'primeros_elementos' => array_slice($data, 0, 3)];
                }
                
                // Si es un objeto individual, devolverlo completo
                return $data;
            }
            
            // Si no se pudo procesar, indicar que es contenido sin procesar
            return ['tipo' => 'consulta_general'];
        } catch (\Exception $e) {
            return ['error' => 'No se pudo extraer datos de la respuesta'];
        }
    }
}