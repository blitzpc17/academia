<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionDocentes extends Model
{
    use HasFactory;

    protected $table = 'docentes_materias';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'docentesId',
        'materiasId'
    ];

    public $timestamps = false;

}
