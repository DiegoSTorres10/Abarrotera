<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use Session;

class Clientescontroller extends Controller
{
    public function Clientes (){

        $clientes = clientes::all();
        return view ('Clientes.Clientes')
        ->with('clientes', $clientes);
    }

    public function Altas_clientes(){
        return view ('Clientes.Altas_clientes');
    }

    public function proceso_clientes(Request $request){
        $this->validate($request, [
            'nombre'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_p'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_m'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'date'=>'required'
        ]);

        $Clientes = new clientes;
        $Clientes->nombre=$request->nombre;
        $Clientes->apellido_p=$request->apellido_p;
        $Clientes->apellido_m=$request->apellido_m;
        $Clientes->fecha_nacimiento=$request->date;
        $Clientes->sexo=$request->sexo;
        $Clientes->save();

        Session::flash('mensaje',"El registro de $request->nombre $request->apellido_p $request->apellido_m ha sido DADO DE ALTA de correctamente");

        return redirect()->route('Clientes');

    }

    public function Borrar_cliente ($id_cliente){
        $Cliente=clientes::find($id_cliente);
        clientes::find($id_cliente)->delete();
        
        Session::flash('Eliminacion',"El cliente $Cliente->nombre $Cliente->apellido_p $Cliente->apellido_m ha sido ELIMINADO correctamente");
        return redirect()->route('Clientes');
    }

    public function Editar_cliente ($id_cliente){
        $Cliente=clientes::find($id_cliente);
        return view ('Clientes.modificaciones_clientes')
        ->with('cliente',$Cliente);
    }

    public function proceso_Modclientes(Request $request){
        $this->validate($request, [
            'nombre'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_p'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_m'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'date'=>'required',
            'id'=>'required'
        ]);
        $Cliente=clientes::find($request->id);

        $Cliente->nombre=$request->nombre;
        $Cliente->apellido_p=$request->apellido_p;
        $Cliente->apellido_m=$request->apellido_m;
        $Cliente->fecha_nacimiento=$request->date;
        $Cliente->sexo=$request->sexo;
        $Cliente->save();

        Session::flash('modificacion',"El registro $request->nombre $request->apellido_p $request->apellido_m ha sido MODIFICADO correctamente");
        return redirect()->route('Clientes');

    }
}
