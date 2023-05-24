<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Tipos;
use Auth;

class TiposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Index(Request $r){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));
        return view('Admin.tipos', compact('cuenta'));
    }

    public function Save(Request $r){ 
        $data = array(
            "nombre" => $r->nombre,     
        );       
        if($r->op=="I") {
            Tipos::create($data);
        }else{
            Tipos::where('id', $r->id)->update($data);
        }     

        return response()->json(["code"=>200, "msj" => "Registro guardado correctamente."]);
    }

    public function Listar(Request $r){
        return Tipos::get();
    }   

    public function Obtener(Request $r){
        $data = Tipos::where('id', $r->id)->first();
        return json_encode($data);
    }
}
