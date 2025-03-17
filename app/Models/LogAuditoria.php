<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class LogAuditoria extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'logs_auditoria';

    protected $fillable = [
        'ip',
        'fecha',
        'endpoint',
        'rol_id',
        'method',
        'id_user'
    ];

    // Definimos los casteos de tipos
    protected $casts = [
        'fecha' => 'datetime',
        'rol_id' => 'integer',
        'id_user' => 'string'
    ];

    // Deshabilitamos los timestamps por defecto ya que usamos 'fecha'
    public $timestamps = false;

    // Método helper para crear un nuevo log
    public static function registrarAcceso($request)
    {
        return self::create([
            'ip' => $request->ip(),
            'fecha' => now(),
            'endpoint' => $request->fullUrl(),
            'rol_id' => auth()->user()->rol ?? null,
            'method' => $request->method(),
            'id_user' => (string)auth()->id()
        ]);
    }
}