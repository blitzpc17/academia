<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    public function authenticate(Request $r){
       
        if (Auth::attempt(['email' => $r->email, 'password' => $r->password])) {
            if (Auth::attempt(['email' => $r->email, 'password' => $r->password, 'activo' => 1])) {
                return redirect()->intended('/')->withSuccess("¡Bienvenido de nuevo! Fecha de Acceso: ".date('d-m-Y H:i:s'));
            }else{
                return back()->withErrors([
                    'password' => '*Cuenta inactiva'
                ]);
            }
        }

        return back()->withErrors([
            'email' => '*Verifique su cuenta de correo',
            'password' => '*Verifique su contraseña'
        ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
