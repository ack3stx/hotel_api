<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAuditoria;
use Illuminate\Support\Facades\DB;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        // Aplicar filtros si existen
        $query = LogAuditoria::query();
        
        if ($request->has('user_id')) {
            $query->where('id_user', $request->user_id);
        }
        
        if ($request->has('ip')) {
            $query->where('ip', $request->ip);
        }
        
        if ($request->has('method')) {
            $query->where('method', strtoupper($request->method));
        }
        
        if ($request->has('fecha_desde')) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }
        
        if ($request->has('fecha_hasta')) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }
        
        if ($request->has('endpoint')) {
            $query->where('endpoint', 'like', '%' . $request->endpoint . '%');
        }
        
        // Ordenar por fecha descendente (más reciente primero)
        $registros = $query->orderBy('fecha', 'desc')->paginate(15);
        
        // Transformar la información para que sea más clara
        $resultados = $registros->getCollection()->map(function ($item) {
            // Obtener información del usuario
            $usuario = \App\Models\User::find($item->id_user);
            $nombreUsuario = $usuario ? $usuario->name : "Usuario #{$item->id_user}";
            
            // Formatear fecha
            $fecha = \Carbon\Carbon::parse($item->fecha)->format('d-m-Y H:i:s');            
            // Obtener el recurso específico desde el endpoint
            $partes = explode('/', $item->endpoint);
            $recurso = '';
            
            // Buscar el recurso después de 'v1' en la URL
            foreach ($partes as $key => $parte) {
                if ($parte == 'v1' && isset($partes[$key + 1])) {
                    $recurso = $this->formatearRecurso($partes[$key + 1]);
                    break;
                }
            }
            
            // Determinar la acción realizada con el recurso específico
            $accion = '';
            switch ($item->method) {
                case 'GET':
                    $accion = "Consultó información de {$recurso}";
                    break;
                case 'POST':
                    $accion = "Registró nuevo {$recurso}";
                    break;
                case 'PUT':
                    $accion = "Actualizó información de {$recurso}";
                    break;
                case 'DELETE':
                    $accion = "Eliminó {$recurso}";
                    break;
            }
            
            // Verificar si hay acciones específicas
            if (strpos($item->endpoint, 'cancelar') !== false) {
                $accion = "Canceló una reservación";
            } elseif (strpos($item->endpoint, 'activar') !== false) {
                $accion = "Activó un usuario";
            } elseif (strpos($item->endpoint, 'desabilitar') !== false) {
                $accion = "Deshabilitó un usuario";
            }
            
            return [
                'usuario' => $nombreUsuario,
                'fecha' => $fecha,
                'accion' => $accion
            ];
        });
        
        // Reemplazar la colección original con la transformada
        $paginaActual = $registros->currentPage();
        $porPagina = $registros->perPage();
        $total = $registros->total();
        $ultimaPagina = $registros->lastPage();
        
        return response()->json([
            'success' => true,
            'data' => $resultados,
            'pagination' => [
                'current_page' => $paginaActual,
                'per_page' => $porPagina,
                'total' => $total,
                'last_page' => $ultimaPagina
            ],
            'message' => 'Registros de auditoría'
        ]);
    }
    
    /**
     * Formatea el nombre del recurso para hacerlo más legible
     */
    private function formatearRecurso($recurso) 
    {
        $recursos = [
            'Reservacion' => 'reservación',
            'Factura' => 'factura',
            'Habitacion' => 'habitación',
            'Huesped' => 'huésped',
            'Mantenimiento' => 'mantenimiento',
            'Empleado' => 'empleado',
            'users' => 'usuario',
            'desabilitar' => 'usuario',
            'activar' => 'usuario',
            'verificar' => 'cuenta'
        ];
        
        return $recursos[$recurso] ?? $recurso;
    }
    
    /**
     * Mostrar detalles de un registro específico
     */
    public function show($id)
    {
        $registro = LogAuditoria::find($id);
        
        if (!$registro) {
            return response()->json([
                'success' => false,
                'message' => 'Registro no encontrado'
            ], 404);
        }
        
        // Obtener información del usuario
        $usuario = \App\Models\User::find($registro->id_user);
        $nombreUsuario = $usuario ? $usuario->name : "Usuario #{$registro->id_user}";
        
        // Formatear fecha
        $fecha = \Carbon\Carbon::parse($registro->fecha)->format('d-m-Y H:i:s');        
        // Obtener el recurso específico desde el endpoint
        $partes = explode('/', $registro->endpoint);
        $recurso = '';
        
        // Buscar el recurso después de 'v1' en la URL
        foreach ($partes as $key => $parte) {
            if ($parte == 'v1' && isset($partes[$key + 1])) {
                $recurso = $this->formatearRecurso($partes[$key + 1]);
                break;
            }
        }
        
        // Determinar la acción realizada con el recurso específico
        $accion = '';
        switch ($registro->method) {
            case 'GET':
                $accion = "Consultó información de {$recurso}";
                break;
            case 'POST':
                $accion = "Registró nuevo {$recurso}";
                break;
            case 'PUT':
                $accion = "Actualizó información de {$recurso}";
                break;
            case 'DELETE':
                $accion = "Eliminó {$recurso}";
                break;
        }
        
        // Verificar si hay acciones específicas
        if (strpos($registro->endpoint, 'cancelar') !== false) {
            $accion = "Canceló una reservación";
        } elseif (strpos($registro->endpoint, 'activar') !== false) {
            $accion = "Activó un usuario";
        } elseif (strpos($registro->endpoint, 'desabilitar') !== false) {
            $accion = "Deshabilitó un usuario";
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $registro->id,
                'usuario' => $nombreUsuario,
                'fecha' => $fecha,
                'accion' => $accion,
                'ip' => $registro->ip
            ],
            'message' => 'Detalle del registro de auditoría'
        ]);
    }
    
    /**
     * Obtener estadísticas de uso por usuario
     */
    public function estadisticasPorUsuario()
    {
        $usuarios = \App\Models\User::all();
        $estadisticas = [];
        
        foreach ($usuarios as $usuario) {
            $consultas = LogAuditoria::where('id_user', $usuario->id)
                ->where('method', 'GET')
                ->count();
                
            $registros = LogAuditoria::where('id_user', $usuario->id)
                ->where('method', 'POST')
                ->count();
                
            $actualizaciones = LogAuditoria::where('id_user', $usuario->id)
                ->where('method', 'PUT')
                ->count();
                
            $eliminaciones = LogAuditoria::where('id_user', $usuario->id)
                ->where('method', 'DELETE')
                ->count();
                
            $total = $consultas + $registros + $actualizaciones + $eliminaciones;
            
            if ($total > 0) {
                $estadisticas[] = [
                    'usuario' => $usuario->name,
                    'consultas' => $consultas,
                    'registros' => $registros,
                    'actualizaciones' => $actualizaciones,
                    'eliminaciones' => $eliminaciones,
                    'total' => $total
                ];
            }
        }
        
        // Ordenar por total de operaciones (descendente)
        usort($estadisticas, function($a, $b) {
            return $b['total'] - $a['total'];
        });
        
        return response()->json([
            'success' => true,
            'data' => $estadisticas,
            'message' => 'Estadísticas de uso por usuario'
        ]);
    }
}