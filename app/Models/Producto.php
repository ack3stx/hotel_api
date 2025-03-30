<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MongoAuditable;


class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    use MongoAuditable;
    protected $fillable = [
        'nombre',
        'precio',
    ];
}
