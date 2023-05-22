<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Personas;

class EstudiantesController extends Controller
{
    public function Index(Request $r){
        return view('Admin.registros');
    }

    public function Save(Request $r){
        $persona = array(                
            "nombres" => $r->nombres,
            "apellidos" => $r->apellidos,
            "fecha_nacimiento" => $r->fechaNacimiento,
            "sexo" => $r->sexo?true:false,
            "baja" => $r->baja?true:false 
        );     

        Personas::Guardar($persona, $r->id, $r->op, );
        $id = 0;
        if($r->op=="I") {
            $id = Personas::ObtenerConsecutivo();
        }else{
            $id = $r->id;
        }

        $fecha = date('Y-m-d H:i:s');

        $estudiante = array(             
            "id" => $id,   
            "matricula" => $r->matricula,	
            "semestre" => $r->semestre,
            "fecha_inscripcion" => $r->fechaInscripcion,	
            "create_at" => $fecha,
            "updated_at" => $fecha	
        );
        
        Estudiante::Guardar($estudiante, $r->op);

        return response()->json(["code"=>200, "msj" => "Registro guardado correctamente."]);
    }

    public function Listar(Request $r){
        return Estudiante::Listar($r->baja);
    }

    public function Baja(Request $r){
        Personas::Guardar(["baja" => $r->status==1?true:false], $r->id, $r->op);
        $accion = $r->status==1?"desactivado":"reactivado";
        return response()->json(["code"=>200, "msj"=>"Registro {$accion} correctamente"]);
    }

    public function Obtener(Request $r){
        return Estudiante::Obtener($r->id);
    }
}
