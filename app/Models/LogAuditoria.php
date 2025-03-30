<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class LogAuditoria extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'auditoria_actualizada';

    protected $fillable = [
        'usuario',      // Nombre del usuario
        'accion',       // GET, POST, PUT, DELETE, etc.
        'endpoint',     // Ruta accedida
        'fecha',        // Fecha y hora
        'datos',        // Datos relevantes (nuevos o modificados)
        'datos_previos' // Solo para actualizaciones
    ];
    
    // Método para registrar acciones
    public static function registrarAccion($request, $modelType = null, $modelId = null, $oldData = null, $newData = null)
    {
        $user = auth()->user();
        $method = $request->method();
        
        $endpoint = self::formatEndpoint($request->fullUrl());
        
        $accionLegible = self::convertirMetodoAAccion($method);
        
        // Crear registro de auditoría
        return self::create([
            'usuario' => $user ? $user->name : 'Sistema',
            'accion' => $accionLegible,
            'endpoint' => $endpoint,
            'fecha' => now()->setTimezone('America/Mexico_City'),
            'datos' => $newData,        // Datos completos actualizados
            'datos_previos' => $oldData // Datos completos anteriores
        ]);
    }
    
    // Convertir método HTTP a texto descriptivo
    private static function convertirMetodoAAccion($method)
    {
        switch ($method) {
            case 'GET':
                return 'Consultó';
            case 'POST':
                return 'Creó';
            case 'PUT':
            case 'PATCH':
                return 'Actualizó';
            case 'DELETE':
                return 'Eliminó';
            default:
                return $method;
        }
    }
    
    // Formatear el endpoint para que sea más legible
    private static function formatEndpoint($fullUrl)
    {
        // Extraer la parte de la URL después del dominio
        $parsedUrl = parse_url($fullUrl);
        $path = $parsedUrl['path'] ?? '';
        
        // Conservar la parte relevante de la ruta
        $pathParts = explode('/', $path);
        $routeParts = [];
        
        foreach ($pathParts as $part) {
            if (!empty($part) && $part !== 'api' && $part !== 'v1') {
                $routeParts[] = $part;
            }
        }
        
        return implode('/', $routeParts);
    }
    
    // Método para obtener los últimos registros
    // Método para obtener los últimos registros
public static function obtenerUltimosRegistros($cantidad = 50)
{
    return self::orderBy('fecha', 'desc')
             ->limit($cantidad)
             ->get()
             ->map(function($log) {
                 // Convertir MongoDB\BSON\UTCDateTime a fecha legible
                 $fechaFormateada = null;
                 if ($log->fecha instanceof \MongoDB\BSON\UTCDateTime) {
                     // Convertir UTCDateTime a timestamp y luego a string
                     $fechaFormateada = date('Y-m-d H:i:s', $log->fecha->toDateTime()->getTimestamp());
                 } else if ($log->fecha instanceof \DateTime) {
                     $fechaFormateada = $log->fecha->format('Y-m-d H:i:s');
                 } else if (is_string($log->fecha)) {
                     $fechaFormateada = $log->fecha;
                 } else {
                     $fechaFormateada = 'Fecha no disponible';
                 }
                 
                 // Formatear la salida para que sea más legible
                 return [
                     'usuario' => $log->usuario,
                     'accion' => $log->accion,
                     'endpoint' => $log->endpoint,
                     'fecha' => $fechaFormateada,
                     'datos' => $log->datos,
                     'datos_previos' => $log->datos_previos
                 ];
             });
}
}