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
    
    <title>Proveedores</title>
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

    
    <h1 class="text-center titulos"> Bienvenido al control de los proveedores</h1>
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
        <a type="button"  href="{{ route('Alta_Proveedor')}}" class="btn btn-success">Alta Proveedor</a>

        <div class="table-responsive bg-light mt-4 ">
            <table class="table text-center">
                <thead class="btn-teal nav-bg text-black">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del provedor </th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($proveedores as $pro)
                    <tr class="table-active">
                        
                        <td> {{$pro->id_provedores}}</td>
                        <td> {{$pro->nombre_empresa}}</td>
                        <td>
                        <a class="badge rounded-pill bg-info" href="{{route('Editar_proveedor', ['id_provedores' => $pro->id_provedores])}}">Modificar</a>
                        <a class="badge rounded-pill bg-danger" href="{{route('Borrar_proveedor', ['id_provedores' => $pro->id_provedores])}}">Eliminar</a>
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