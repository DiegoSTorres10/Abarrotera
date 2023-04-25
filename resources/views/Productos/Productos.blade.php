<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/Clientes.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/menu.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <title>Productos</title>
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


    <div class="container">

    
    <h1 class="text-center titulos"> Bienvenido a los productos</h1>
    @if (Session::has('mensaje'))
        <div class="alert alert-success font-italic" role="alert">
            {{ Session::get('mensaje')}}
        </div>
        @elseif (Session::has('Eliminacion'))
        <div class="alert alert-danger font-italic" role="alert">
            {{ Session::get('Eliminacion')}}
        </div>
        @elseif (Session::has('modificacion'))
        <div class="alert alert-info font-italic" role="alert">
            {{ Session::get('modificacion')}}
        </div>
    @endif

        <a type="button"  href="{{ route('Altas_Productos')}}" class="btn btn-success">Alta Producto</a>

        <div class="table-responsive bg-light mt-4 ">
            <table class="table text-center">
                <thead class="btn-teal nav-bg text-black">
                    <tr>
                        <th scope="col">Nombre producto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($productos as $pro)
                    <tr class="table-active">
                        
                        <td> {{$pro-> nombre_producto}}</td>
                        <td> {{$pro->descripcion }}</td>
                        <td> {{$pro->nombre_empresa }}</td>
                        <td> {{$pro->nombre_categoria }}</td>
                        <td> {{$pro->cantidad }}</td>
                        <td> {{$pro->costo }}</td>
                        <td> <img src="{{asset('archivos/'. $pro->foto)}}" alt="" height=50 width=50 ></td>
                        <td>
                            <a class="badge rounded-pill bg-info" href="{{route('Editar_productos',['id_producto'=> $pro->id_producto])}}">Modificar</a> 
                            <a class="badge rounded-pill bg-danger" href="{{route('Borrar_productos',['id_producto'=> $pro->id_producto])}}">Eliminar</a>                           
                        </td>
                      
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop