<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use App\Models\provedores;
use App\Models\categorias;
use App\Models\inventario;
use Session;

class Inventariocontroller extends Controller
{
    public function Inventario (){

        $productos = \DB::select("select p.id_producto, p.nombre_producto, p.descripcion, pr.nombre_empresa, ca.nombre_categoria, p.cantidad, p.costo, p.foto from productos as p, categorias as ca, provedores as pr WHERE ca.id_categoria = p.id_categoria and p.id_provedores=pr.id_provedores");
        return view ('Inventario.Inventario')
        ->with('productos', $productos);
        
        
    }

}
