<?php

namespace App\Http\Controllers;


use App\Models\promociones;
use App\Models\productos;
use App\Models\categorias;
use App\Models\provedores;
use Illuminate\Http\Request;
use Session;


class PromocionesController extends Controller
{
    public function ReportePromociones (){

    
        $consulta = \DB::select("select p.id_promocion, p.id_producto, p.precio_antiguo, pd.nombre_producto, pr.nombre_empresa, p.porcentaje_aumento, pd.costo, p.fecha_finalizacion, p.estatus FROM promociones as p, productos as pd, provedores as pr WHERE p.id_producto = pd.id_producto and pd.id_provedores = pr.id_provedores ORDER BY estatus DESC");
        return view ('Promociones.ReportePromociones')
        ->with('promociones', $consulta);
    }

    public function NuevaPromocion (){

        $productos = \DB::select("SELECT *
        FROM productos
        WHERE id_producto NOT IN (
          SELECT id_producto
          FROM promociones
          WHERE fecha_finalizacion >= CURDATE()
        )");
        return view ('Promociones.NuevaPromocion')->with('productos', $productos);
        
    }

    
    public function ProductoSinPromocion(Request $request)
    {
        $productos = promociones::where('id_producto', "=", $request->id_producto)
            ->where('fecha_finalizacion', '>=', \DB::raw('CURDATE()'))->count();
        $existencias = ($productos > 0) ? 1 : 0;
        return response()->json(['existencias' => $existencias]);
    }

    public function DetallesProducto (Request $request){

        $productos = productos::where('id_producto',"=", $request->id_producto)->get();
        $categorias = categorias::all();
        $proveedores = provedores::all();
        return view ('Promociones.infoProductos')->with('productos', $productos[0])
        ->with('categorias',$categorias)
        ->with('proveedores', $proveedores);
    }

    #Para solcitar el numero de existencias por medio de json
    public function ExistenciasProducto (Request $request){
        $productos = productos::where('id_producto',"=", $request->id_producto)->get();
        $existencias = $productos[0]->cantidad;
        return response()->json(['existencias' => $existencias]);
    }
    

    #Para solcitar el precio del producto por medio de json
    public function PrecioProducto (Request $request){
        $productos = productos::where('id_producto',"=", $request->id_producto)->get();
        $precio = $productos[0]->costo;
        return response()->json(['precio' => $precio]);
    }

    public function Carrito_descuentos (Request $request){
        
        $producto = productos::find($request->id);
        $PRECIOANTIGUO = $producto->costo;
        $producto->costo = $request->precio;
        $producto->save();

        $numero_entero = intval($request->id);
        $promocion = new promociones();
        $promocion->id_producto = $numero_entero;
        $promocion->precio_antiguo = $PRECIOANTIGUO;
        $promocion->porcentaje_aumento = $request->porcentaje;
        $promocion->fecha_finalizacion = $request->fechaVen;
        $promocion->save();
        $consulta = \DB::select("SELECT prom.id_promocion, prom.id_producto, prom.porcentaje_aumento, prom.fecha_finalizacion, prom.precio_antiguo, prod.nombre_producto, prod.costo FROM promociones as prom, productos as prod WHERE prom.id_producto = prod.id_producto");

        return view('Promociones.Carrito_descuentos')
        ->with('consulta',$consulta);
    }

    
    public function borrardescuentos(Request $request)
    {
        $promocion = Promociones::find($request->id_promocion);
        if ($promocion) {
            $producto = Productos::find($promocion->id_producto);
            
            $producto->costo = $promocion->precio_antiguo;
            $producto->save();
            
            $promocion->delete();
        }
        
        $consulta = \DB::select("SELECT prom.id_promocion, prom.porcentaje_aumento, prom.fecha_finalizacion, prom.id_producto, prod.nombre_producto, prod.costo, prom.precio_antiguo, prom.porcentaje_aumento, prom.fecha_finalizacion FROM promociones as prom, productos as prod WHERE prom.id_producto = prod.id_producto");

        return view('Promociones.Carrito_descuentos')
            ->with('consulta', $consulta);
    }

    public function Editar_promocion(Request $request)
    {
        $seleccionProducto = \DB::select ("SELECT prom.id_promocion, prod.id_producto, prod.nombre_producto, prom.precio_antiguo, prom.porcentaje_aumento, prom.fecha_finalizacion  FROM productos as prod, promociones as prom WHERE prom.id_producto = prod.id_producto and prom.id_promocion = $request->id_promocion");
        return view('Promociones.Modificaciones_carrito')
            ->with('seleccionProducto', $seleccionProducto);
    }

    public function Carrito_descuentos_reajuste (Request $request){
        
        $producto = productos::find($request->id);
        $producto->costo = $request->precio;
        $producto->save();

        $promociones = promociones::find($request->id_promocion );
        $promociones->porcentaje_aumento = $request->porcentaje_aumento;
        $promociones->fecha_finalizacion = $request->fechaVen;
        $promociones->save();
        $consulta = \DB::select("SELECT prom.id_promocion, prom.id_producto, prom.precio_antiguo, prod.nombre_producto, prod.costo, prom.porcentaje_aumento, prom.fecha_finalizacion FROM promociones as prom, productos as prod WHERE prom.id_producto = prod.id_producto");

        return view('Promociones.Carrito_descuentos')
        ->with('consulta',$consulta);
    }

    public function Editar_promocion_carrito(Request $request)
    {
        $seleccionProducto = \DB::select ("SELECT prom.id_promocion, prod.id_producto, prod.nombre_producto, prom.precio_antiguo, prom.porcentaje_aumento, prom.fecha_finalizacion  FROM productos as prod, promociones as prom WHERE prom.id_producto = prod.id_producto and prom.id_promocion = $request->id_promocion");
        return view('Promociones.Modificaciones_carrito')
            ->with('seleccionProducto', $seleccionProducto);
    }
    
}
