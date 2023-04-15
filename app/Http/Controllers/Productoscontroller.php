<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use App\Models\provedores;
use App\Models\categorias;
use Session;

class Productoscontroller extends Controller
{
    public function Productos (){

        $productos = \DB::select("select p.id_producto, p.nombre_producto, p.descripcion, pr.nombre_empresa, ca.nombre_categoria, p.cantidad, p.costo, p.foto from productos as p, categorias as ca, provedores as pr WHERE ca.id_categoria = p.id_categoria and p.id_provedores=pr.id_provedores");
        return view ('Productos.Productos')
        ->with('productos', $productos);
        
    }

    public function Altas_Productos (){

        $categorias = categorias::all();
        $proveedores = provedores::all();
        return view ('Productos.Alta_productos')
        ->with('categorias', $categorias)
        ->with('proveedores', $proveedores);
        
    }

    public function proceso_productos(Request $request){

        $this->validate($request,[
            'nombre'=>'regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,Í,É,Ó,0-9]+$/',
            'cantidad'=>'required|numeric|integer',
            'costo'=>'required|numeric',
            'proveedor'=>'required',
            'descripcion'=>'required',
            'categoria'=>'required',
            'foto'=>'mimes:jpg,png,jpeg'
        ]);
        $file = $request->file('foto');
        if($file!=""){
            $ldate = date('Ymd_His_');
            $img = $file->getClientOriginalName();
            $img2 = $ldate.$img;
            \Storage::disk('local')->put($img2, \File::get($file));
        }
        else{
            $img2 = "SinFoto.jpg";
        }

        $productos = new productos();
        $productos->id_provedores= $request->proveedor;
        $productos->id_categoria = $request->categoria;
        $productos->nombre_producto = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->cantidad = $request->cantidad;
        $productos->costo= $request->costo;
        $productos->foto = $img2;
        $productos->save();

        Session::flash('mensaje',"El producto $request->nombre ha sido CREADO correctamente");
        return redirect()->route('Productos');
    }


    public function Borrar_productos ($id_producto){
        $pro=productos::find($id_producto);
        productos::find($id_producto)->delete();
        
        Session::flash('Eliminacion',"El producto $pro->nombre_producto ha sido ELIMINADO correctamente");
        return redirect()->route('Productos');
    }

    public function Editar_productos ($id_producto){

        $productos = productos::find($id_producto);
        $categorias = categorias::all();
        $proveedores = provedores::all();
        return view ('Productos.Modificacion_producto')
        ->with('categorias', $categorias)
        ->with('proveedores', $proveedores)
        ->with ('productos', $productos);
    }

    public function proceso_modificacion (Request $request){
        
        $this->validate($request,[
            'nombre'=>'regex:/^[a-z,A-Z, ,á,é,í,ó,ú,Á,Í,É,Ó,0-9]+$/',
            'cantidad'=>'required|numeric|integer',
            'costo'=>'required|numeric',
            'proveedor'=>'required',
            'descripcion'=>'required',
            'categoria'=>'required',
            'foto'=>'mimes:jpg,png,jpeg'
        ]);

        $productos = productos::find($request->id);
    
        $file = $request->file('foto');
        if($file!=""){
            $ldate = date('Ymd_His_');
            $img = $file->getClientOriginalName();
            $img2 = $ldate.$img;
            \Storage::disk('local')->put($img2, \File::get($file));
        }
        else{
            $img2 = $productos->foto;
        }

        $productos->id_provedores= $request->proveedor;
        $productos->id_categoria = $request->categoria;
        $productos->nombre_producto = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->cantidad = $request->cantidad;
        $productos->costo= $request->costo;
        if ($img2 != $productos->foto){
            $productos->foto = $img2;
        }
        $productos->save();


        Session::flash('modificacion',"El producto $request->nombre ha sido MODIFICADO correctamente");
        return redirect()->route('Productos');
    }
}
