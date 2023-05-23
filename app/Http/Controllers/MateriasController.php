<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materias;
use Auth;

class MateriasController extends Controller
{
    public function Index(Request $r){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));
        return view('Admin.materias', compact('cuenta'));
    }

    public function Save(Request $r){ 
        $data = array(
            "nombre" => $r->nombre,           
            "activo" => true
        );       
        if($r->op=="I") {
            Materias::create($data);
        }else{
            Materias::where('id', $r->id)->update($data);
        }     

        return response()->json(["code"=>200, "msj" => "Registro guardado correctamente."]);
    }

    public function Listar(Request $r){
        return Materias::get();
    }

    public function Baja(Request $r){
        Materias::where('id', $r->id)->update(["activo" => $r->status==0?false:true]);
        $accion = $r->status==0?"desactivado":"reactivado";
        return response()->json(["code"=>200, "msj"=>"Registro {$accion} correctamente"]);
    }

    public function Obtener(Request $r){
        $data = Materias::where('id', $r->id)->first();
        return json_encode($data);
    }
}
