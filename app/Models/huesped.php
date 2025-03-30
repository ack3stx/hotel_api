<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MongoAuditable;


class huesped extends Model
{
    use HasFactory, SoftDeletes, MongoAuditable;
    protected $table = 'huespeds';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'correo'
    ];
}
