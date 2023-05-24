<?php 


namespace App\Models;

class Utilidades 
{
    public static function SubirArchivos($archivo, $ruta){
        
        $image = $archivo;
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($ruta), $new_name);

        return $new_name;
    }

  
}
