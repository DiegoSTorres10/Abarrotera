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
    
    <title>Clientes</title>
</head>
<body>
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
@if (is_null(Session::get('sesiontipo')))
    <script>
        window.location = "{{ route('login') }}";
    </script>
@elseif (Session::get('sesiontipo')==1)
    <script>
        window.location = "{{ route('Productos') }}";
    </script>
@else


    <div class="container">

    
    <h1 class="text-center titulos"> Bienvenido al control de los clientes</h1>
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

        <p>Si desea agregar un nuevo cliente haga click en el siguiente botón</p>
        <a type="button"  href="{{ route('Altas_clientes')}}" class="btn btn-success">Alta Cliente</a>

        <div class="table-responsive bg-light mt-4 ">
            <table class="table text-center">
                <thead class="btn-teal nav-bg text-black">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $cli)
                    <tr class="table-active">
                        
                        <td> {{$cli->nombre}}</td>
                        <td> {{$cli->apellido_p }}</td>
                        <td> {{$cli->apellido_m }}</td>
                        <td> {{$cli->fecha_nacimiento }}</td>
                        <td> {{$cli->sexo}}</td>
                        <td>
                            <a class="badge rounded-pill bg-info" href="{{route('Editar_cliente',['id_cliente'=> $cli->id_cliente])}}">Modificar</a>
                            <a class="badge rounded-pill bg-danger" href="{{route('Borrar_cliente',['id_cliente'=> $cli->id_cliente])}}">Eliminar</a>
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