<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'tipo',
        'activo',
        'fecha_bloqueo',
        'personasId'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function ObtenerCuentaData($id){
        $data = DB::table('personas as per')
        ->join('users as us', 'per.Id', 'us.personasId')
        ->where('us.id', $id)
        ->select('us.id', DB::raw("CONCAT(per.nombres, ' ', per.apellidos) as nombre"), 
        DB::raw("CASE WHEN us.tipo='E' THEN 'ESTUDIANTE' ELSE (CASE WHEN us.tipo='D' THEN 'DOCENTE' ELSE 'ADMIN' END ) END as nombreTipo "))
        ->first();

        return json_encode($data);
    }
}
