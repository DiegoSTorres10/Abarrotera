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
    
    <title>Vendedor</title>
</head>
<body>
@if (is_null(Session::get('sesiontipo')))
    <script>
        window.location = "{{ route('login') }}";
    </script>
@elseif (Session::get('sesiontipo')==2)
    <script>
        window.location = "{{ route('Clientes') }}";
    </script>
@else

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')


    <div class="container">

    
    <h1 class="text-center titulos"> Bienvenido al control de los vendedores</h1>
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

        <a type="button"  href="{{ route('Altas_vendedor')}}" class="btn btn-success">Alta Vendedor</a>

        <div class="table-responsive bg-light mt-4 ">
            <table class="table text-center">
                <thead class="btn-teal nav-bg text-black">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Domicilio</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Estado</th>
                        <th scope="col">CURP</th>
                        <th scope="col">fecha de nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($vendedores as $ven)
                    <tr class="table-active">
                        
                        <td> {{$ven-> nombre}}</td>
                        <td> {{$ven->apellido_p }}</td>
                        <td> {{$ven->apellido_m }}</td>
                        <td> {{$ven->domicilio }}</td>
                        <td> {{$ven->ciudad }}</td>
                        <td> {{$ven->nombre_estado }}</td>
                        <td> {{$ven->curp }}</td>
                        <td> {{$ven->fecha_nacimiento }}</td>
                        <td> {{$ven->sexo}}</td>
                        <td> {{$ven->usuario}}</td>
                        <td>
                            <a class="badge rounded-pill bg-info" href="{{route('Editar_v',['id_vendedor'=> $ven->id_vendedor])}}">Modificar</a> 
                            <a class="badge rounded-pill bg-danger" href="{{route('Borrar_v',['id_vendedor'=> $ven->id_vendedor])}}">Eliminar</a>                           
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