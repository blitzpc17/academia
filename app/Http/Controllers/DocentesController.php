<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Personas;
use Auth;
use App\Models\User;

class DocentesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Index(Request $r){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));
        return view('Admin.docentes_registros', compact('cuenta'));
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

        $Docente = array(             
            "id" => $id,   
            "rfc" => $r->rfc,	
            "fecha_contratacion" => $r->fechaContratacion,	
            "create_at" => $fecha,
            "updated_at" => $fecha	
        );
        
        Docente::Guardar($Docente, $r->op);

        return response()->json(["code"=>200, "msj" => "Registro guardado correctamente."]);
    }

    public function Listar(Request $r){
        return Docente::Listar($r->baja);
    }

    public function Baja(Request $r){
        Personas::Guardar(["baja" => $r->status==1?true:false], $r->id, $r->op);
        $accion = $r->status==1?"desactivado":"reactivado";
        return response()->json(["code"=>200, "msj"=>"Registro {$accion} correctamente"]);
    }

    public function Obtener(Request $r){
        return Docente::Obtener($r->id);
    }
}
