<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clientescontroller;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\Categoriacontroller;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\Productoscontroller;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\PromocionesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// ---------Clientes------------------
Route::get('Clientes', [Clientescontroller::class,'Clientes'])->name('Clientes');
Route::get('Altas_clientes', [Clientescontroller::class,'Altas_clientes'])->name('Altas_clientes');
Route::POST('proceso_clientes',[Clientescontroller::class,'proceso_clientes'])->name('proceso_clientes');
Route::get('Borrar_cliente/{id_cliente}',[Clientescontroller::class, 'Borrar_cliente'])->name('Borrar_cliente');
Route::get('Editar_cliente/{id_cliente}',[Clientescontroller::class, 'Editar_cliente'])->name('Editar_cliente');
Route::POST('proceso_Modclientes', [Clientescontroller::class, 'proceso_Modclientes'])->name('proceso_Modclientes');
//Vendedores
Route::get('Vendedor', [VendedorController::class,'Vendedor'])->name('Vendedor');
Route::get('Altas_vendedor', [VendedorController::class, 'Altas_vendedor'])->name('Altas_vendedor');
Route::POST('registrando_v', [VendedorController::class, 'registrando_v'])->name('registrando_v');
Route::get('Editar_v/{id_vendedor}',[VendedorController::class, 'Editar_v'])->name('Editar_v');
Route::POST('modificando',[VendedorController::class, 'modificando'])->name('modificando');
Route::get('Borrar_v/{id_vendedor}',[VendedorController::class, 'Borrar_v'])->name('Borrar_v');

//Categorias
Route::get('Categorias', [Categoriacontroller::class,'Categorias'])->name('Categorias');
Route::get('Alta_Categoria', [Categoriacontroller::class,'Alta_Categoria'])->name('Alta_Categoria');
Route::POST('proceso_categoria', [Categoriacontroller::class, 'proceso_categoria'])->name('proceso_categoria');
Route::get('Editar_categoria/{id_categoria}',[Categoriacontroller::class, 'Editar_categoria'])->name('Editar_categoria');
Route::POST('proceso_modificacion',[Categoriacontroller::class, 'proceso_modificacion'])->name('proceso_modificacion');
Route::get('Borrar_categoria/{id_categoria}',[Categoriacontroller::class, 'Borrar_categoria'])->name('Borrar_categoria');


// Proveedores
Route::get('Proveedores', [ProveedoresController::class,'Proveedores'])->name('Proveedores');
Route::get('Alta_Proveedor', [ProveedoresController::class,'Alta_Proveedor'])->name('Alta_Proveedor');
Route::POST('proceso_proveedor', [ProveedoresController::class, 'proceso_proveedor'])->name('proceso_proveedor');
Route::get('Editar_proveedor/{id_provedores}',[ProveedoresController::class, 'Editar_proveedor'])->name('Editar_proveedor');
Route::POST('proceso_modificacion',[ProveedoresController::class, 'proceso_modificacion'])->name('proceso_modificacion');
Route::get('Borrar_proveedor/{id_provedores}',[ProveedoresController::class, 'Borrar_proveedor'])->name('Borrar_proveedor');

//Productos
Route::get('Productos', [Productoscontroller::class,'Productos'])->name('Productos');
Route::get('Altas_Productos', [Productoscontroller::class,'Altas_Productos'])->name('Altas_Productos');
Route::POST('proceso_productos', [Productoscontroller::class, 'proceso_productos'])->name('proceso_productos');
Route::get('Editar_productos/{id_producto}',[Productoscontroller::class, 'Editar_productos'])->name('Editar_productos');
Route::POST('proceso_modificacion',[Productoscontroller::class, 'proceso_modificacion'])->name('proceso_modificacion');
Route::get('Borrar_productos/{id_producto}',[Productoscontroller::class, 'Borrar_productos'])->name('Borrar_productos');


Route::get('login', [AccesoController::class,'login'])->name('login');
Route::POST('procesar_login', [AccesoController::class, 'procesar_login'])->name('procesar_login');
Route::get('CerrarSesion', [AccesoController::class,'CerrarSesion'])->name('CerrarSesion');

//Promociones Editar_promocion
Route::get('ReportePromociones', [PromocionesController::class,'ReportePromociones'])->name('ReportePromociones');
Route::get('Editar_promocion/{id_promocion}',[PromocionesController::class, 'Editar_promocion'])->name('Editar_promocion');
Route::get('NuevaPromocion',[PromocionesController::class, 'NuevaPromocion'])->name('NuevaPromocion');
Route::get('DetallesProducto',[PromocionesController::class, 'DetallesProducto'])->name('DetallesProducto');
Route::get('ExistenciasProducto',[PromocionesController::class, 'ExistenciasProducto'])->name('ExistenciasProducto');
Route::get('PrecioProducto',[PromocionesController::class, 'PrecioProducto'])->name('PrecioProducto');
Route::get('Carrito_descuentos',[PromocionesController::class,'Carrito_descuentos'])->name('Carrito_descuentos');
Route::get('ProductoSinPromocion',[PromocionesController::class,'ProductoSinPromocion'])->name('ProductoSinPromocion');
Route::get('borrardescuentos',[PromocionesController::class,'borrardescuentos'])->name('borrardescuentos');
Route::get('Carrito_descuentos_reajuste',[PromocionesController::class,'Carrito_descuentos_reajuste'])->name('Carrito_descuentos_reajuste');
Route::get('Editar_promocion_carrito',[PromocionesController::class, 'Editar_promocion_carrito'])->name('Editar_promocion_carrito');



