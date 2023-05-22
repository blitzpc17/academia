<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Personas extends Model
{
    use HasFactory;

    public static function ObtenerConsecutivo(){
        $data = DB::table('personas')->orderbydesc('id')->select('id')->first();
        return $data->id;
    }

    public static function Guardar($obj, $id, $op){        
        if($id!=null){  
            if($op=='D'){
                DB::table('personas')->where('id', $id)->update(["baja"=>$obj["baja"]]);
            }else{
                DB::table('personas')->where('id', $id)->update($obj);
            }   
           
        }else{
            DB::table('personas')->insert($obj);
        }
    }
}
