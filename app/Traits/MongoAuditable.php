<?php

namespace App\Traits;

use App\Models\LogAuditoria;
use Illuminate\Support\Facades\Request;

trait MongoAuditable
{
    protected $auditOriginalDataTemporal;

    protected static function bootMongoAuditable()
    {
        static::created(function ($model) {
            $request = Request::instance();
            LogAuditoria::registrarAccion(
                $request, 
                get_class($model), 
                $model->id, 
                null, 
                $model->toArray()
            );
        });

        static::updating(function ($model) {
            $model->auditOriginalDataTemporal = $model->getOriginal();
        });
        
        static::updated(function ($model) {
            $request = Request::instance();
            
            $oldData = $model->auditOriginalDataTemporal ?? [];
            
            LogAuditoria::registrarAccion(
                $request,
                get_class($model),
                $model->id,
                $oldData,
                $model->toArray()
            );
        });

        static::deleted(function ($model) {
            $request = Request::instance();
            LogAuditoria::registrarAccion(
                $request,
                get_class($model),
                $model->id,
                $model->toArray(),
                null
            );
        });
    }
    
    /**
     * Método para registrar manualmente una consulta
     * Puede usarse en los controladores para registrar GET
     * 
     * @param bool $coleccion Si es true, registra que se consultó una colección en lugar de un elemento específico
     * @return $this
     */
    public function registrarConsulta($coleccion = false)
    {
        $request = Request::instance();
        
        $datos = $coleccion 
            ? ['tipo' => 'consulta_coleccion', 'conteo' => 1] 
            : $this->toArray();
        
        LogAuditoria::registrarAccion(
            $request,
            get_class($this),
            $coleccion ? null : $this->id,
            null,
            $datos
        );
        
        return $this;
    }
    
    /**
     * Método estático para registrar consultas de colecciones
     * 
     * @param mixed $collection La colección que se consultó
     * @return void
     */
    public static function registrarConsultaColeccion($collection)
    {
        $request = Request::instance();
        
        $datos = [
            'tipo' => 'consulta_coleccion',
            'modelo' => static::class,
            'conteo' => $collection instanceof \Illuminate\Database\Eloquent\Collection 
                ? $collection->count() 
                : (is_countable($collection) ? count($collection) : 1)
        ];
        
        LogAuditoria::registrarAccion(
            $request,
            static::class,
            null, 
            null, 
            $datos
        );
    }
}