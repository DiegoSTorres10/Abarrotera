<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendedores;
use App\Models\estados;
use App\Models\usuarios;
use Illuminate\Support\Facades\Hash;
use Session;

class VendedorController extends Controller
{

    public function Vendedor (){

        // $vendedores1 = vendedores::all();

        $vendedores = \DB::select("select c.id_vendedor, c.nombre, c.apellido_p, c.apellido_m, c.domicilio, c.ciudad, e.nombre_estado, c.curp, c.fecha_nacimiento, c.sexo, u.usuario FROM vendedores as c, usuarios as u, estados as e WHERE CONCAT(c.nombre, ' ', c.apellido_p, ' ', c.apellido_m) LIKE u.nombre_completo and e.id_estado = c.id_estado");
        return view ('Vendedor.Vendedor')
        ->with('vendedores', $vendedores);
        
    }
    //Se llama primero a las vistas, luego controlador y luego nos vamos a web
    public function Altas_vendedor(){
        
        $estados = estados::all();
        return view ('Vendedor.Altas_vendedor')->with('estados', $estados);
        
    }

    public function registrando_v(Request $request){
        echo $request->date;
        $this->validate($request, [
            'nombre'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_p'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_m'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'domicilio'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'estado'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'date'=>'required'
        ]);

        $Vendedores = new vendedores();
        $Vendedores ->nombre=$request->nombre;
        $Vendedores ->apellido_p=$request->apellido_p;
        $Vendedores ->apellido_m=$request->apellido_m;
        $Vendedores ->domicilio=$request->domicilio;
        $Vendedores ->ciudad=$request->estado;
        $Vendedores ->id_estado=$request->id_estado;
        $Vendedores ->curp=$request->curp;
        $Vendedores ->fecha_nacimiento=$request->date;
        $Vendedores ->sexo=$request->sexo;
        $Vendedores ->save();

        $id = $Vendedores->id_vendedor;
        


        $usuarios = new usuarios();
        $usuarios->usuario = $request->nombre.$id;
        $nombreCompleto = $request->nombre . ' ' . $request->apellido_p . ' ' . $request->apellido_m;
        $usuarios->nombre_completo = $nombreCompleto;
        $usuarios->password = Hash::make($request->nombre.$id);
        $usuarios->rol=2;
        $usuarios->save();

        Session::flash('mensaje',"El registro de $request->nombre $request->apellido_p $request->apellido_m ha sido DADO DE ALTA de correctamente, su usuario es: $request->nombre$id");

        return redirect()->route('Vendedor');

    }

    public function Editar_v ($id_vendedor){
        $estados = estados::all();
        $vendedores=vendedores::find($id_vendedor);
        return view ('Vendedor.modificar_vendedor')
        ->with('vendedores',$vendedores)
        ->with('estados', $estados);
    }

    public function modificando(Request $request){
        $this->validate($request, [
            'nombre'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_p'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'apellido_m'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'domicilio'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'estado'=>'required|regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/',
            'date'=>'required'
        ]);
        $vendedores=vendedores::find($request->id);
        $nombreantigui = $vendedores->nombre;
        $vendedores->nombre=$request->nombre;
        $vendedores->apellido_p=$request->apellido_p;
        $vendedores->apellido_m=$request->apellido_m;
        $vendedores->domicilio=$request->domicilio;
        $vendedores->ciudad=$request->estado;
        $vendedores->id_estado=$request->id_estado;
        $vendedores->curp=$request->curp;
        $vendedores->fecha_nacimiento=$request->date;
        $vendedores->sexo=$request->sexo;
        $vendedores->save();

        $usuario_modificar = $nombreantigui.$request->id;
        $usuarios = usuarios::where('usuario', '=', $usuario_modificar)->first();
        $usuarios->usuario = $request->nombre.$request->id;
        $nombreCompleto = $request->nombre . ' ' . $request->apellido_p . ' ' . $request->apellido_m;
        $usuarios->nombre_completo = $nombreCompleto;
        $usuarios->save();

        Session::flash('modificacion',"El registro $request->nombre $request->apellido_p $request->apellido_m y el usuario ha sido modificado correctamente");
        return redirect()->route('Vendedor');

    }
    public function Borrar_v ($id_vendedor){
        $Vendedor=vendedores::find($id_vendedor);
        vendedores::find($id_vendedor)->delete();

        
        $usuario_modificar = $Vendedor->nombre.$id_vendedor;
        $usuarios = usuarios::where('usuario', '=', $usuario_modificar)->first();
        $usuarios->delete();
        
        Session::flash('Eliminacion',"El vendedor (a): $Vendedor->nombre $Vendedor->apellido_p $Vendedor->apellido_m y su usuario han sido eliminado correctamente");
        return redirect()->route('Vendedor');
    }
}
