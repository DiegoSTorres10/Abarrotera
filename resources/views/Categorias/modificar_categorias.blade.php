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

    <title>Modificación categoria</title>
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
        <h1 class="text-center titulos"> Modificación de categorias</h1>
        <hr>

        <form action="{{route('proceso_modificacion')}}" method="POST" class="bg-fluid pb-3" autocomplete=off>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label mt-3" for="nombre">Id de la categoria<span>*</span></label>
                        <input required readonly class="text-dark form-control" type="text" name="id" id="id" value ="{{$categoria->id_categoria}}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label mt-3" for="nombre">Nombre de la categoria<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="nombre" id="nombre" value="{{$categoria->nombre_categoria}}" placeholder="Nombre de la categoria"> 
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-3">
                <a class="btn btn-danger me-md-2" href="{{route ('Categorias')}}" type="button">Regresar</a>
                <button class="btn btn-primary" type="summt">Guardar</button>
            </div>
        </form>

    </div>

    <script type='text/javascript'>
    
        $(document).ready(function (){
            
            jQuery("#nombre").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
        })
    </script>
</body>
</html>

@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop