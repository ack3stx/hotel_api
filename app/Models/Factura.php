<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MongoAuditable;


class Factura extends Model
{
    use HasFactory, SoftDeletes, MongoAuditable;
    protected $table = 'facturas';
}
