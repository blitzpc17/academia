<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use DB;
use Auth;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Index(Request $r){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));
        return view('Admin.usuarios', compact('cuenta'));
    }

    public function Save(Request $r){ 
        $data = array(
            "email" => $r->email,
            "password" => Hash::make($r->password),
            "tipo" => $r->tipo,
            "personasId" => $r->personasId,
            "activo" => $r->op=="I"?true:($r->status==1?true:false)
        );       
        if($r->op=="I") {
            User::create($data);
        }else{
            User::where('id', $r->id)->update($data);
        }     

        return response()->json(["code"=>200, "msj" => "Registro guardado correctamente."]);
    }

    public function Listar(Request $r){
        return DB::table('users as us')
                ->join('personas as per', 'us.personasId', 'per.Id')
                ->select('us.id', 'us.email as correo', DB::raw("concat(per.nombres, ' ', per.apellidos) as nombre"), 'us.activo',
                'us.tipo', DB::raw("CASE WHEN us.tipo = 'E' then 'ESTUDIANTE' else (CASE WHEN  us.tipo = 'D' then 'DOCENTE' else 'SISTEMA' END ) END as NombreTipo"))
                ->get();
    }

    public function Baja(Request $r){
        User::where('id', $r->id)->update(["activo" => $r->status==0?false:true, "fecha_bloqueo" => date('Y-m-d H:i:s')]);
        $accion = $r->status==0?"desactivado":"reactivado";
        return response()->json(["code"=>200, "msj"=>"Registro {$accion} correctamente"]);
    }

    public function Obtener(Request $r){
        $data = DB::table('users as us')
        ->join('personas as per', 'us.personasId', 'per.id')
        ->select('us.id', 'us.email as correo', 'per.id as personasId',
        'us.tipo', DB::raw("CASE WHEN us.tipo = 'E' then 'ESTUDIANTE' else (CASE WHEN  us.tipo = 'D' then 'DOCENTE' else 'SISTEMA' END ) END as nombreTipo"))
        ->where('us.id', $r->id)        
        ->first();

        return json_encode($data);
    }
}
