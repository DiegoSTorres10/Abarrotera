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

    <title>Alta cliente</title>
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
        <h1 class="text-center titulos"> Alta de clientes</h1>
        <hr>

        <form action="{{route('proceso_clientes')}}" method="POST" class="bg-fluid pb-3" autocomplete=off id="Foma" >
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label mt-3" for="nombre">Nombre (s)<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="nombre" id="nombre" placeholder="Nombre (s)"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label  mt-3" for="apellido_p">Apellido Paterno<span>*</span></label>
                        <input required class="text-dark form-control" type="text" name="apellido_p" id="apellido_p" placeholder="Apellido Paterno">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="apellido_m">Apellido materno<span>*</span></label>
                        <input required class="text-dark form-control" type="text" name="apellido_m" id="apellido_m" placeholder="Apellido Materno">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label  mt-3" for="date">Fecha de nacimiento<span>*</span></label>
                        <input class="text-dark form-control" required type="date" name="date" id="date">
                    </div>
                    <div class="mb-3">
                        <label for="sexo" class="form-label mt-3">Género <span>*</span></label>
                        <input required type="radio" name="sexo" id="Masculino" value="Masculino" >Masculino
                        <input required type="radio" name="sexo" id="Femenino" value="Femenino"> Femenino 
                        <input required type="radio" name="sexo" id="No binario" value="No binario"> No binario
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                        <a class="btn btn-danger me-md-2" href="{{route ('Clientes')}}" type="button">Regresar</a>
                        <button class="btn btn-primary" type="summt">Guardar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script type='text/javascript'>
        $(document).ready(function (){
            jQuery("#nombre").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#apellido_p").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#apellido_m").on('input', function () {
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