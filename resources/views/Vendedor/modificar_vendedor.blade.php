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

    <title>Modificación Vendedor</title>
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
        <h1 class="text-center titulos"> Modificación de vendedores</h1>
        <hr>


        <form action="{{route('modificando')}}" method="POST" id="Foma" class="bg-fluid pb-3" autocomplete="off">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id form-label " class="mt-3">ID </label>
                        <input class="form-control" type="text" name="id" id="id" readonly value="{{$vendedores->id_vendedor}}">
                    </div>
                    <div class="mb-3">
                        <label class="mt-3 form-label " for="nombre">Nombre (s)<span>*</span></label>
                        <input required class="form-control" type="text" value="{{$vendedores->nombre}}" name="nombre" id="nombre" placeholder="nombre"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="apellido_p">Apellido Paterno<span>*</span></label>
                        <input required class="form-control" type="text" value="{{$vendedores->apellido_p}}" name="apellido_p" id="apellido_p" placeholder="Apellido Paterno">
                    </div>
                    <div class="mb-3">
                        <label class="form-label  mt-3" for="apellido_m">Apellido Materno<span>*</span></label>
                        <input required class="form-control" type="text" value="{{$vendedores->apellido_m}}" name="apellido_m" id="apellido_m" placeholder="Apellido Materno">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="curp" requied>CURP<span>*</span></label>
                        <input required class="form-control text-uppercase" type="text" value="{{$vendedores->curp}}" name="curp" id="curp" placeholder="curp" maxlength="18">
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label  mt-3" for="domicilio">Domicilio<span>*</span></label>
                        <input required class="form-control"type="text" value="{{$vendedores->domicilio}}" name="domicilio" id="domicilio" placeholder="Domicilio">
                    </div>
                    <div class="mb-3">
                        <label class="form-label  mt-3" for="ciudad">Ciudad <span>*</span></label>
                        <input required class="form-control" type="text" value="{{$vendedores->ciudad}}" name="estado" id="estado" placeholder="Ciudad">
                    </div>
                    <div class="mb-3">
                        <label class="form-label  mt-3" for="id_estado" required>Estado<span>*</span></label>
                        <select class="form-control" name="id_estado" id="id_estado" required>
                            <option class="form-control" value="" disabled > -- Seleccione su estado --</option>
                            @foreach ($estados as $estado )
                                @if ($estado->id_estado == $vendedores->id_estado)
                                    <option class="form-control" value="{{$estado->id_estado}}" selected>{{$estado->nombre_estado}}</option>
                                @else
                                    <option class="form-control" value="{{$estado->id_estado}}">{{$estado->nombre_estado}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                    <label class="form-label  mt-3" for="date">Fecha de nacimiento<span>*</span></label>
                        <input class="form-control" required type="date" name="date" value="{{$vendedores->fecha_nacimiento}}" id="date">
                    </div>
                    <div class="mb-3">
                    <label for="sexo" class="form-label mt-3">Sexo<span>*</span></label>
                        @if ($vendedores->sexo == 'Masculino')
                        <input required type="radio" name="sexo" id="Masculino" value="Masculino" checked="" > <span class=""> Masculino </span>
                        <input required type="radio" name="sexo" id="Femenino" value="Femenino">  <span class=""> Femenino </span>  
                        <input required type="radio" name="sexo" id="No binario" value="No binario">  <span class=""> No binario </span>
                        @elseif ($vendedores->sexo == 'Femenino')
                        <input required type="radio" name="sexo" id="Masculino" value="Masculino" > <span class=""> Masculino </span> 
                        <input required type="radio" name="sexo" id="Femenino" value="Femenino" checked="">  <span class=""> Femenino </span> 
                        <input required type="radio" name="sexo" id="No binario" value="No binario">  <span class=""> No binario </span>
                        @else
                        <input required type="radio" name="sexo" id="Masculino" value="Masculino"  > <span class=""> Masculino </span> 
                        <input required type="radio" name="sexo" id="Femenino" value="Femenino">  <span class=""> Femenino </span> 
                        <input required type="radio" name="sexo" id="No binario" value="No binario" checked="">  <span class=""> No binario </span> 
                        <br>
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                <a class="btn btn-danger me-md-2" href="{{route ('Vendedor')}}" type="button">Regresar</a>
                <button class="btn btn-primary" type="summt">Guardar</button>
            </div>
        </form>

    </div>

    <script type='text/javascript'>
        $(document).ready(function (){
            jQuery("#nombre").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#apellido_p").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#apellido_m").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#domicilio").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#estado").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/g, ''));
            });
            jQuery("#curp").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú,1,2,3,4,5,6,7,8,9,0]+$/g, ''));
            });

            var bandera = true;
            
            var curpRegex = /^[A-Z]{4}\d{6}[H,M][A-Z]{5}\w\d$/;
            $('#curp').on('keyup', function() {
            if (curp.length == 18 && curpRegex.test(curp)) {
                var curp = $(this).val()
                $(this).val(curp.toUpperCase());
                $(this).css('color', 'green');
                bandera = true;
            } else {
                $(this).css('color', 'red');
                bandera = false;
            }
        });

        
            $('#Foma').submit(function(event){

                if (bandera == false) {
                    event.preventDefault()
                }

            })

        })
    </script>
</body>
</html>
@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop