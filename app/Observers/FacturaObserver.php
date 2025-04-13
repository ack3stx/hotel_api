<?php

namespace App\Observers;

use App\Models\Factura;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class FacturaObserver
{
    /**
     * Handle the Factura "created" event.
     *
     * @param  \App\Models\Factura  $factura
     * @return void
     */
    public function created(Factura $factura)
    {
        try {
            Log::info('Factura creada', ['id' => $factura->id]);
            $this->notifySSEClients($factura, 'created');
            
            // Actualizar caché global de última factura
            Cache::put('ultima_factura_global', $factura->id, 3600);
            Cache::put('ultima_factura_global_timestamp', $factura->created_at->timestamp, 3600);
        } catch (\Exception $e) {
            Log::error('Error en observer created', [
                'factura_id' => $factura->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Factura "updated" event.
     *
     * @param  \App\Models\Factura  $factura
     * @return void
     */
    public function updated(Factura $factura)
    {
        try {
            Log::info('Factura actualizada', ['id' => $factura->id]);
            $this->notifySSEClients($factura, 'updated');
            
            // Actualizar caché global de última factura
            Cache::put('ultima_factura_global', $factura->id, 3600);
            Cache::put('ultima_factura_global_timestamp', $factura->updated_at->timestamp, 3600);
        } catch (\Exception $e) {
            Log::error('Error en observer updated', [
                'factura_id' => $factura->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Factura "deleted" event.
     *
     * @param  \App\Models\Factura  $factura
     * @return void
     */
    public function deleted(Factura $factura)
    {
        try {
            Log::info('Factura eliminada', ['id' => $factura->id]);
            $this->notifySSEClients($factura, 'deleted');
            
            // Actualizar caché global de última factura
            Cache::put('ultima_factura_global', $factura->id, 3600);
            Cache::put('ultima_factura_global_timestamp', now()->timestamp, 3600);
            Cache::put('ultima_factura_global_action', 'deleted', 3600);
        } catch (\Exception $e) {
            Log::error('Error en observer deleted', [
                'factura_id' => $factura->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Factura "restored" event.
     *
     * @param  \App\Models\Factura  $factura
     * @return void
     */
    public function restored(Factura $factura)
    {
        try {
            Log::info('Factura restaurada', ['id' => $factura->id]);
            $this->notifySSEClients($factura, 'restored');
            
            // Actualizar caché global
            Cache::put('ultima_factura_global', $factura->id, 3600);
            Cache::put('ultima_factura_global_timestamp', now()->timestamp, 3600);
            Cache::put('ultima_factura_global_action', 'restored', 3600);
        } catch (\Exception $e) {
            Log::error('Error en observer restored', [
                'factura_id' => $factura->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Factura "force deleted" event.
     *
     * @param  \App\Models\Factura  $factura
     * @return void
     */
    public function forceDeleted(Factura $factura)
    {
        try {
            Log::info('Factura eliminada permanentemente', ['id' => $factura->id]);
            $this->notifySSEClients($factura, 'force_deleted');
            
            // Actualizar caché global
            Cache::put('ultima_factura_global', $factura->id, 3600);
            Cache::put('ultima_factura_global_timestamp', now()->timestamp, 3600);
            Cache::put('ultima_factura_global_action', 'force_deleted', 3600);
        } catch (\Exception $e) {
            Log::error('Error en observer forceDeleted', [
                'factura_id' => $factura->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Notificar a los clientes SSE de forma eficiente
     *
     * @param  \App\Models\Factura  $factura
     * @param  string  $action
     * @return void
     */
    private function notifySSEClients(Factura $factura, $action)
    {
        try {
            // Directorio donde se almacenan los archivos de bloqueo
            $lockDir = storage_path('app/sse_locks');
            
            // Verificar que el directorio exista o crearlo
            if (!file_exists($lockDir)) {
                if (!mkdir($lockDir, 0755, true) && !is_dir($lockDir)) {
                    throw new \RuntimeException('No se pudo crear el directorio: ' . $lockDir);
                }
            }
            
            // Evitar múltiples notificaciones para la misma factura en poco tiempo
            $notificationKey = 'notified_factura_' . $factura->id . '_' . $action;
            if (Cache::has($notificationKey)) {
                Log::info('Notificación ya enviada, evitando duplicación', [
                    'factura_id' => $factura->id,
                    'action' => $action,
                    'time_since_last' => now()->diffInSeconds(Cache::get($notificationKey . '_time'))
                ]);
                return;
            }
            
            // Marcar esta notificación como enviada (con 10 segundos de protección)
            Cache::put($notificationKey, true, 10);
            Cache::put($notificationKey . '_time', now(), 10);
            
            // Preparar datos para notificación
            $notificationData = json_encode([
                'timestamp' => now()->toDateTimeString(),
                'factura_id' => $factura->id,
                'action' => $action
            ]);
            
            // Obtener archivos de bloqueo, pero ahora usar caché para la lista de clientes activos
            $activeClientsKey = 'sse_active_clients';
            $activeCacheTime = 60; // 1 minuto
            
            $activeClients = Cache::remember($activeClientsKey, $activeCacheTime, function() use ($lockDir) {
                return glob($lockDir . '/user_*.lock');
            });
            
            if (empty($activeClients)) {
                Log::info('No hay clientes SSE activos');
                return;
            }
            
            // Iterar a través de clientes e intentar actualizar sus archivos
            $updatedClients = 0;
            foreach ($activeClients as $file) {
                try {
                    // Verificar si el archivo existe y cuándo fue la última vez que se tocó
                    if (file_exists($file) && is_writable($file)) {
                        $lastModified = filemtime($file);
                        $timeAgo = time() - $lastModified;
                        
                        // Si el archivo no se ha modificado en los últimos 10 minutos,
                        // probablemente el cliente ya no está conectado
                        if ($timeAgo > 600) {
                            Log::info('Eliminando archivo de bloqueo inactivo', [
                                'file' => basename($file),
                                'inactive_for' => $timeAgo . ' segundos'
                            ]);
                            @unlink($file);
                            continue;
                        }
                        
                        // Actualizar archivo de bloqueo
                        file_put_contents($file, $notificationData);
                        $updatedClients++;
                    }
                } catch (\Exception $e) {
                    Log::warning('Error actualizando archivo de bloqueo', [
                        'file' => basename($file),
                        'error' => $e->getMessage()
                    ]);
                    
                    // Intentar eliminar archivo problemático
                    if (file_exists($file)) {
                        @unlink($file);
                    }
                }
            }
            
            // Registrar resultado
            Log::info('Notificación SSE enviada', [
                'factura_id' => $factura->id,
                'action' => $action,
                'clients_notified' => $updatedClients,
                'total_clients' => count($activeClients)
            ]);
            
            // Si se detectaron cambios en la lista de clientes activos, actualizar caché
            if ($updatedClients != count($activeClients)) {
                Cache::forget($activeClientsKey);
            }
            
        } catch (\Exception $e) {
            Log::error('Error general en Observer', [
                'error' => $e->getMessage(),
                'factura_id' => $factura->id,
                'action' => $action
            ]);
        }
    }
}