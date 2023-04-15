<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;
use Session;

class Categoriacontroller extends Controller
{
    public function Categorias (){

        $categorias = categorias::all();

        return view ('Categorias.categorias')
        ->with('categorias', $categorias);
        
    }

    public function Alta_Categoria (){
        return view ('Categorias.alta_categoria');
        
    }

    public function proceso_categoria(Request $request){

        $this->validate($request,[
            'nombre'=>'required',
        ]);

        $cate = new categorias();
        $cate->nombre_categoria=$request->nombre;
        $cate->save();

        Session::flash('mensaje',"El registro de la categoria $request->nombre ha sido DADO DE ALTA de correctamente");
        return redirect()->route('Categorias');
    }

    public function Borrar_categoria ($id_categoria){
        $cate=categorias::find($id_categoria);
        categorias::find($id_categoria)->delete();
        
        Session::flash('Eliminacion',"La categoria $cate->nombre_categoria ha sido ELIMINADO correctamente");
        return redirect()->route('Categorias');
    }

    public function Editar_categoria ($id_categoria){
        $cate=categorias::find($id_categoria);
        return view ('Categorias.modificar_categorias')
        ->with('categoria',$cate);
    }

    public function proceso_modificacion (Request $request){
        $this->validate($request,[
            'nombre'=>'required',
        ]);
        $cate=categorias::find($request->id);

        $cate->nombre_categoria=$request->nombre;
        $cate->save();


        Session::flash('modificacion',"La categoria $request->nombre ha sido MODIFICADO correctamente");
        return redirect()->route('Categorias');

    }


}
