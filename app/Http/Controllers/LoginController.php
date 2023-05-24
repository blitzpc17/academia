<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    public function authenticate(Request $r){
       
        if (Auth::attempt(['email' => $r->email, 'password' => $r->password])) {         
            $user = auth()->user();
            if($user->activo==0){
                return back()->withErrors([                       
                    'password' => '*Usuario inactivo'
                ]);
            }
            if($user->tipo=='S'||$user->tipo=='D'||$user->tipo=='E'){
                return redirect()->intended('/')->withSuccess("¡Bienvenido de nuevo! Fecha de Acceso: ".date('d-m-Y H:i:s'));
            }else{
                return redirect()->intended('login')->withSuccess("Usuario no válido");;
            }
        }

        return back()->withErrors([
            'email' => '*Verifique su cuenta de correo',
            'password' => '*Verifique su contraseña'
        ])->withInput();;
    }

    public function logout(){
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
