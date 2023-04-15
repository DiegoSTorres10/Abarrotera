<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuarios;
use Session;
use Illuminate\Support\Facades\Hash;

class AccesoController extends Controller
{
    public function login()
    {
        return view ('login');

    }

    public function procesar_login(Request $request){
        $this->validate($request,[
            'usuario'=>'required',
            'password'=>'required'
        ]);

        $usuario = usuarios::where('usuario','=',$request->usuario)->first();

        if ($usuario) {
            if (Hash::check($request->password, $usuario->password)) {
                if ($usuario->rol == 1){
                    Session::put('sesionname',$usuario->usuario);
                    Session::put('sesiontipo',$usuario->rol);
                    return redirect()->route('Productos');
                }
                else{
                    Session::put('sesionname',$usuario->usuario);
                    Session::put('sesiontipo',$usuario->rol);
                    return redirect()->route('Clientes');
                }
            } else {
                Session::flash('error', 'La contraseña no es la correcta');
            return redirect()->route('login');
            }
        }
        else {
            Session::flash('error', 'El usuario no existe');
            return redirect()->route('login');
        }
    }
    public function CerrarSesion()
    {
        Session::forget('sesionname');
        Session::forget('sesiontipo');
        Session::flush();
        Session::flash('CerrarSesion', 'Sesión Cerrada Correctamente');
        return redirect()->route('login');

    }
    
}
