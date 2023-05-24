<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    use HasFactory;
    protected $table = 'tipo_actividades';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;


}
