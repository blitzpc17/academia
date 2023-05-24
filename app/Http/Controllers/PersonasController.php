<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PersonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Listar(Request $r){
        $tipo = $r->tipo;
        if($tipo == "E"){

            return DB::table('personas as per')
            ->join('estudiantes as doc', 'per.id', 'doc.id')
            ->select('per.id', DB::raw("CONCAT(per.nombres, ' ', per.apellidos) as nombre"))
            ->get();

        }else if($tipo == "D"){
            return DB::table('personas as per')
                    ->join('docentes as doc', 'per.id', 'doc.id')
                    ->select('per.id', DB::raw("CONCAT(per.nombres, ' ', per.apellidos) as nombre"))
                    ->get();

        }else{
            //todos
            return DB::table('personas as per')
                ->select('per.id', DB::raw("CONCAT(per.nombres, ' ', per.apellidos) as nombre"))
                ->get();
        }
       
    }
}
