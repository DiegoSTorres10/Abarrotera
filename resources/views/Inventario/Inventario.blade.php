<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/Clientes.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/formulario.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/menu.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/fixedHeader.dataTables.min.css')}}">
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.fixedHeader.min.js')}}"></script>

    <title> Inventario</title>

</head>
<body>
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
@if (is_null(Session::get('sesiontipo')))
    <script>
        window.location = "{{ route('login') }}";
    </script>
@elseif (Session::get('sesiontipo')==2)
    <script>
        window.location = "{{ route('Clientes') }}";
    </script>
@else



    <main>
        <div class="container">

            <h1 class="text-center titulos"> Inventario de productos </h1>
            <form action="" method="" class="bg-fluid pb-3" enctype="multipart/form-data" autocomplete=off id="Foma" >
                <div class="mb-3">
                    <label class="form-label mt-3" for="producto">Producto<span>*</span></label>
                        <select required name="producto" id="producto">
                            <option value="" selected disabled>--Escoja el producto--</option>
                            @foreach ($productos as $pro)
                                <option value="{{$pro->id_producto}}">{{$pro->nombre_producto}}</option>
                            @endforeach
                        </select>
                    
                    
                    <div  class="mb-3">
                        <label class="form-label mt-3" for="categoria">Categoria<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="categoria" id="categoria" value="{{$categoria->nombre_categoria}}" placeholder="Nombre de la categoria"> 
                        
                    </div>

                    <div>
                        <label class="mt-3 mb-2  letraLabel" for="existencia">Detalles</label>
                        <input disabled type="radio" class="mx-1" name="detalles_producto" id="Si">Si
                        <input disabled type="radio" class="mx-1" name="detalles_producto" id="No">No
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    <div id="Descu" class="d-none">
                        <label class="form-label mt-3" for="categoria">Cantidad ingresada<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="can_ingresada" id="cant_ingresada" placeholder="Cantidad ingresada"> 
                        

                        <label class="form-label mt-3" for="categoria">Cantidad inexistencia<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="can_" id="cant_inexistencia" placeholder="Nombre de la categoria"> 
                        

                        <label class="form-label mt-3" for="categoria">Catantidad disponible<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="cant_dispo" id="cant_dispo" placeholder="Nombre de la categoria"> 
                        
                        
                    </div>
                    
                   

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">

                        <input type="button" value="Mostrar"  class="btn btn-primary" id='AgregarDes' name='AgregarDes' disabled>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Cantidad</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    <div>
                        <label class="mt-3 mb-2  letraLabel" for="existencia">Ver Proveedor</label>
                        <input disabled type="radio" class="mx-1" name="proveedor" id="Si">Si
                        <input disabled type="radio" class="mx-1" name="proveedor" id="No">No
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID proveedor</th>
                                <th scope="col">Nombre</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                             
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    <div>
                        <label class="mt-3 mb-2  letraLabel" for="existencia">Ver todos los productos</label>
                        <input disabled type="radio" class="mx-1" name="productos" id="Si">Si
                        <input disabled type="radio" class="mx-1" name="productos" id="No">No
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Foto</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <th scope="row">1</th>
                                <td>Mark</td>
                             
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">

                        <input type="button" value="Mostrar"  class="btn btn-primary" id='CantidadDispo' name='CantidadDispo' disabled>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Cantidad disponible</th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Mark</td>
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                        <a class="btn btn-danger me-md-2" href="" type="button">Regresar</a>
                        <input type="button" value="Agregar Descuento"  class="btn btn-primary" id='AgregarDes' name='AgregarDes' disabled>
                    </div>





                    <!-- Carrito de los descuentos -->
                 
                </div>
            </form>

        </div>
    </main>


    <script type="text/javascript">
    
    </script>
</body>
</html>

@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop