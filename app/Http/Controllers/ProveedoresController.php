<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provedores;
use Session;
class ProveedoresController extends Controller
{
    public function Proveedores (){

        $provedores = provedores::all();

        return view ('Proveedores.Proveedores')
        ->with('proveedores', $provedores);
        
    }

    public function Alta_Proveedor (){
        return view ('Proveedores.alta_provedor');
        
    }

    public function proceso_proveedor (Request $request){
        $this->validate($request,[
            'nombre'=>'required',
        ]);

        $pro = new provedores();
        $pro->nombre_empresa=$request->nombre;
        $pro->save();

        Session::flash('mensaje',"El registro del proveedor $request->nombre ha sido DADO DE ALTA de correctamente");
        return redirect()->route('Proveedores');
    }

    public function Borrar_proveedor ($id_provedores){
        $pro=provedores::find($id_provedores);
        provedores::find($id_provedores)->delete();
        
        Session::flash('Eliminacion',"El proveedor $pro->nombre_empresa ha sido ELIMINADO correctamente");
        return redirect()->route('Proveedores');
    }

    public function Editar_proveedor  ($id_provedores){
        $pro=provedores::find($id_provedores);
        return view ('Proveedores.modificar_proveedor')
        ->with('proveedor',$pro);
    }

    public function proceso_modificacion (Request $request){

        $pro=provedores::find($request->id);

        $pro->nombre_empresa=$request->nombre;
        $pro->save();


        Session::flash('modificacion',"El proveedor $request->nombre ha sido MODIFICADO correctamente");
        return redirect()->route('Proveedores');

    }
}
