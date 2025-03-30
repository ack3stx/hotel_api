<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\MongoAuditable;


class Reservacion extends Model
{
    use HasFactory, SoftDeletes, MongoAuditable;
    
    protected $table = 'reservacions';
}