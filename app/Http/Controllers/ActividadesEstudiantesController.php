<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;


class ActividadesEstudiantesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Index(){
        $user = Auth::user();
        $cuenta = json_decode(User::ObtenerCuentaData($user->id));
        $actividades = "";
        return view('Estudiantes.monitoreo_actividades', compact('cuenta', 'actividades'));
    }

    public function Save(Request $r){

        $data = array(
            'docentesMateriasId' => $r->docenteMateria,
            'tipoActividadesId' => $r->tipo,
            'titulo' => $r->titulo,
            'descripcion' => $r->descripcion,
            'fechaInicio' => $r->fechaInicio,
            'fechaEntrega'  => $r->fechaEntrega,           
            'examen' => $r->examen,
            'estado' => $r->estado
        );
        if(isset($r->material) &&$r->material!=null){
            $data = array_merge($data, ['materialAdjunto'  => Utilidades::SubirArchivos($r->material, 'actividades/docentes/materialapoyo')]);
        } 

        if($r->op=='I'){
            ActividadesDocentes::create($data);
        }else{
            ActividadesDocentes::where('id', $r->id)->update($data);
        }

        return response()->json(["code"=>200, "msj"=>"Registro guardado correctamente"]);
    }

    public function Listar(Request $r){
        return DB::table('materias_actividades as ma')
                ->join('tipo_actividades as ta', 'ma.tipoActividadesId', 'ta.id')
                ->join('docentes_materias as dm', 'ma.docentesMateriasId', 'dm.materiasId')
                ->join('materias as m', 'dm.materiasId', 'm.id')
                ->where('dm.docentesId', $r->id)
                ->select('ma.id', 'ma.titulo', 'ta.nombre as tipo', DB::raw("CASE WHEN ma.estado=1 THEN 'PROGRAMADA' ELSE (CASE WHEN ma.estado=2 THEN 'CERRADA' ELSE 'CANCELADA' END) END AS estado"))
                ->get();
    }

    public function Obtener(Request $r){
        $data = DB::table('materias_actividades as ma')
            ->join('tipo_actividades as ta', 'ma.tipoActividadesId', 'ta.id')
            ->join('docentes_materias as dm', 'ma.docentesMateriasId', 'dm.materiasId')
            ->where('ma.id', $r->id)
            ->select('ma.id', 'ma.tipoActividadesId', 'ma.titulo', 'ma.descripcion', 'ma.fechaInicio', 'ma.fechaEntrega', 
            'ma.estado as estadoId', 'ma.examen', 'ma.materialAdjunto', 'ta.nombre as tipo', 'dm.id as materiasId',
            DB::raw("CASE WHEN ma.estado=1 THEN 'PROGRAMADA' ELSE (CASE WHEN ma.estado=2 THEN 'CERRADA' ELSE 'CANCELADA' END) END AS estado"))
            ->first();

        return json_encode($data);
    }
}
