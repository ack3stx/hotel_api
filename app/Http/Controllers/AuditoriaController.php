<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAuditoria;

class AuditoriaController extends Controller
{
    public function index(Request $request)
{
    $cantidad = $request->get('cantidad', 50);
    
    try {
        $todosDocumentos = LogAuditoria::raw(function($collection) use ($cantidad) {
            return $collection->find(
                [], // Sin filtro
                ['sort' => ['_id' => -1], 'limit' => intval($cantidad)]
            )->toArray();
        });
        
        \Log::info('MongoDB - Documentos directos: ' . count($todosDocumentos));
        
        $registros = [];
        
        foreach ($todosDocumentos as $documento) {
            if ($documento instanceof \MongoDB\Model\BSONDocument) {
                $documento = (array)$documento;
            }
            
            // Intenta encontrar la fecha en diferentes posibles ubicaciones
            $fechaFormateada = 'Fecha no disponible';
            
            // 1. Verifica si hay un campo fecha
            if (isset($documento['fecha'])) {
                if ($documento['fecha'] instanceof \MongoDB\BSON\UTCDateTime) {
                    $fechaFormateada = date('Y-m-d H:i:s', $documento['fecha']->toDateTime()->getTimestamp());
                } elseif (is_string($documento['fecha'])) {
                    $fechaFormateada = $documento['fecha'];
                }
            } 
            // 2. Verifica created_at
            elseif (isset($documento['created_at'])) {
                if ($documento['created_at'] instanceof \MongoDB\BSON\UTCDateTime) {
                    $fechaFormateada = date('Y-m-d H:i:s', $documento['created_at']->toDateTime()->getTimestamp());
                } elseif (is_string($documento['created_at'])) {
                    $fechaFormateada = $documento['created_at'];
                }
            }
            // 3. Si hay datos.created_at o datos.updated_at (para consultas GET)
            elseif (isset($documento['datos']) && is_array($documento['datos'])) {
                if (isset($documento['datos']['created_at'])) {
                    $fechaFormateada = $documento['datos']['created_at'];
                } elseif (isset($documento['datos']['updated_at'])) {
                    $fechaFormateada = $documento['datos']['updated_at'];
                }
            }
            
            // Respaldo: Usar la fecha de creación del ID de MongoDB
            if ($fechaFormateada === 'Fecha no disponible' && isset($documento['_id'])) {
                $timestamp = hexdec(substr((string)$documento['_id'], 0, 8));
                $fechaFormateada = date('Y-m-d H:i:s', $timestamp);
            }
            
            // Para depuración, muestra la estructura del documento
            if ($fechaFormateada === 'Fecha no disponible') {
                \Log::info('Documento sin fecha detectada: ' . json_encode(array_keys($documento)));
                
                // Verificar si existen campos de tiempo en el primer nivel
                $camposTiempo = ['timestamp', 'time', 'date', 'dateTime', 'created', 'modified'];
                foreach ($camposTiempo as $campo) {
                    if (isset($documento[$campo])) {
                        $fechaFormateada = is_string($documento[$campo]) 
                            ? $documento[$campo] 
                            : json_encode($documento[$campo]);
                        break;
                    }
                }
            }
            
            $registro = [
                'id' => isset($documento['_id']) ? (string)$documento['_id'] : '',
                'usuario' => $documento['usuario'] ?? 'Desconocido',
                'accion' => $documento['accion'] ?? 'Desconocida',
                'endpoint' => $documento['endpoint'] ?? '',
                'fecha' => $fechaFormateada,
                'datos' => $documento['datos'] ?? null
            ];
            
            // Añadir datos_previos solo si existen
            if (isset($documento['datos_previos'])) {
                $registro['datos_previos'] = $documento['datos_previos'];
            }
            
            $registros[] = $registro;
        }
        
        \Log::info('Total de registros procesados: ' . count($registros));
        
        return response()->json($registros);
    } catch (\Exception $e) {
        \Log::error('Error en AuditoriaController@index: ' . $e->getMessage());
        \Log::error('Línea: ' . $e->getLine() . ' en ' . $e->getFile());
        
        return response()->json([
            'error' => 'Error al obtener registros de auditoría',
            'mensaje' => $e->getMessage(),
            'linea' => $e->getLine(),
            'archivo' => $e->getFile()
        ], 500);
    }
}
    
    public function filtrar(Request $request)
    {
        $query = LogAuditoria::query();
        
        // Aplicar filtros desde la solicitud - usando nombres de campo correctos
        if ($request->has('usuario')) {
            $query->where('usuario', 'like', '%' . $request->usuario . '%');
        }
        
        if ($request->has('accion')) {
            $query->where('accion', $request->accion);
        }
        
        if ($request->has('fecha_desde')) {
            // Convertir a formato MongoDB de fecha
            $desde = new \MongoDB\BSON\UTCDateTime(strtotime($request->fecha_desde) * 1000);
            $query->where('fecha', '>=', $desde);
        }
        
        if ($request->has('fecha_hasta')) {
            // Convertir a formato MongoDB de fecha
            $hasta = new \MongoDB\BSON\UTCDateTime(strtotime($request->fecha_hasta) * 1000);
            $query->where('fecha', '<=', $hasta);
        }
        
        if ($request->has('endpoint')) {
            $query->where('endpoint', 'like', '%' . $request->endpoint . '%');
        }
        
        try {
            $registros = $query->orderBy('fecha', 'desc')
                ->limit($request->get('cantidad', 50))
                ->get()
                ->map(function($log) {
                    // Formatear la fecha correctamente
                    $fechaFormateada = null;
                    if ($log->fecha instanceof \MongoDB\BSON\UTCDateTime) {
                        $fechaFormateada = date('Y-m-d H:i:s', $log->fecha->toDateTime()->getTimestamp());
                    } else if ($log->fecha instanceof \DateTime) {
                        $fechaFormateada = $log->fecha->format('Y-m-d H:i:s');
                    } else if (is_string($log->fecha)) {
                        $fechaFormateada = $log->fecha;
                    } else {
                        $fechaFormateada = 'Fecha no disponible';
                    }
                    
                    // Retornar el formato estandarizado
                    return [
                        'usuario' => $log->usuario,
                        'accion' => $log->accion,
                        'endpoint' => $log->endpoint,
                        'fecha' => $fechaFormateada,
                        'datos' => $log->datos,
                        'datos_previos' => $log->datos_previos
                    ];
                });
            
            return response()->json($registros);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al filtrar registros de auditoría',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }
    
    public function estadisticasPorUsuario()
    {
        try {
            // Agrupar por usuario y acción, contar - usando nombres de campo correctos
            $result = LogAuditoria::raw(function($collection) {
                return $collection->aggregate([
                    ['$group' => [
                        '_id' => [
                            'usuario' => '$usuario',
                            'accion' => '$accion'
                        ],
                        'count' => ['$sum' => 1],
                        'ultima_fecha' => ['$max' => '$fecha']
                    ]],
                    ['$sort' => ['_id.usuario' => 1, 'count' => -1]]
                ]);
            });
            
            // Formatear el resultado para que sea más amigable
            $formateado = collect($result)->map(function($item) {
                $ultimaFecha = null;
                
                // Formatear la fecha si está disponible
                if (isset($item['ultima_fecha'])) {
                    if ($item['ultima_fecha'] instanceof \MongoDB\BSON\UTCDateTime) {
                        $ultimaFecha = date('Y-m-d H:i:s', $item['ultima_fecha']->toDateTime()->getTimestamp());
                    } else {
                        $ultimaFecha = date('Y-m-d H:i:s', strtotime($item['ultima_fecha']));
                    }
                }
                
                return [
                    'usuario' => $item['_id']['usuario'],
                    'accion' => $item['_id']['accion'],
                    'total' => $item['count'],
                    'ultima_fecha' => $ultimaFecha
                ];
            })->groupBy('usuario');
            
            return response()->json($formateado);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener estadísticas',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }
    
    // Método para ver los últimos 10 cambios a cierta entidad (ej: Habitacion, Huesped)
    public function cambiosRecientes($entidad)
    {
        try {
            $registros = LogAuditoria::where('endpoint', 'like', '%' . $entidad . '%')
                ->where('accion', '!=', 'Consultó')  // Excluir consultas
                ->orderBy('fecha', 'desc')
                ->limit(10)
                ->get()
                ->map(function($log) {
                    // Formatear la fecha correctamente
                    $fechaFormateada = null;
                    if ($log->fecha instanceof \MongoDB\BSON\UTCDateTime) {
                        $fechaFormateada = date('Y-m-d H:i:s', $log->fecha->toDateTime()->getTimestamp());
                    } else if ($log->fecha instanceof \DateTime) {
                        $fechaFormateada = $log->fecha->format('Y-m-d H:i:s');
                    } else if (is_string($log->fecha)) {
                        $fechaFormateada = $log->fecha;
                    } else {
                        $fechaFormateada = 'Fecha no disponible';
                    }
                    
                    return [
                        'usuario' => $log->usuario,
                        'accion' => $log->accion,
                        'endpoint' => $log->endpoint,
                        'fecha' => $fechaFormateada,
                        'datos' => $log->datos,
                        'datos_previos' => $log->datos_previos
                    ];
                });
            
            return response()->json($registros);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener cambios recientes',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }
}