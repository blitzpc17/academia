<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use App\Models\ActividadesDocentes;
use App\Models\ActividadesEstudiantes;
use App\Models\Utilidades;


class ActividadesEstudiantesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Index(){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));     
        $actividades = ActividadesDocentes::ListarActividadesMateriasXEstudiante($cuenta->personasId);
      //  dd($actividades);
        return view('Estudiantes.monitoreo_actividades', compact('cuenta', 'actividades'));
    }

    public function Save(Request $r){
        $fecha= date('Y-m-d H:i:s');
        $dataActividad = ActividadesEstudiantes::where('id', $r->id)->first(); 

        $data = array(
            'estudiantesId'=>$r->estudiante,
            'materiasActividadesId'=>$r->id,
            'estado'=>$dataActividad!=null?2:1,//entregado 1, resubido 2
            'productoEstudiante'=>$r->observaciones,
            'fechaEntrega'=>$fecha,
            'ultimaModificacion' => $fecha,
            'vecesModificado' => $dataActividad!=null?($dataActividad->vecesModificado + 1):1
        );

        if(isset($r->material) &&$r->material!=null){
            $data = array_merge($data, ['materialAdjunto'  => Utilidades::SubirArchivos($r->material, 'actividades/estudiantes/productos')]);
        } 

        if($dataActividad!=null){
            ActividadesEstudiantes::where('id', $dataActividad->id)->update($data);           
        }else{
            ActividadesEstudiantes::create($data);
        }

        return response()->json(["code"=>200, "msj"=>"Actividad subida correctamente"]);
    }
    
}
