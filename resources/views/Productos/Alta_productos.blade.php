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

    <title>Alta productos</title>
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
        <h1 class="text-center titulos"> Alta de productos</h1>
        <hr>

        <form action="{{route('proceso_productos')}}" method="POST" class="bg-fluid pb-3" enctype="multipart/form-data" autocomplete=off id="Foma" >
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label mt-3" for="nombre">Nombre del producto<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="nombre" id="nombre" placeholder="Nombre del producto"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="descripcion">Descripción<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="descripcion" id="descripcion" placeholder="Descripcion del producto"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="foto">Foto del producto</label> <br>
                        <img id="imagen-seleccionada" src="{{asset('archivos/SinFoto.jpg')}}" class="img" alt="">
                        <input type="file" class="" id="foto" name="foto" accept=".jpg,.png,.gif,.jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label mt-3" for="proveedor">Proveedor<span>*</span></label>
                        <select required name="proveedor" id="proveedor">
                            <option value="" selected disabled>--Escoja el proveedor--</option>
                            @foreach ($proveedores as $pro)
                                <option value="{{$pro->id_provedores}}">{{$pro->nombre_empresa}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                    <label class="form-label mt-3" for="categoria">Categoria<span>*</span></label>
                        <select required name="categoria" id="categoria">
                            <option value="" selected disabled>--Escoja la categoria--</option>
                            @foreach ($categorias as $ca)
                                <option value="{{$ca->id_categoria}}">{{$ca->nombre_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="cantidad">Cantidad<span>*</span></label>
                        <input required  class="text-dark form-control" type="number" name="cantidad" id="cantidad" min="1" placeholder="Cantidad del producto"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label mt-3" for="costo">Costo<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" min="0"  name="costo" id="costo" placeholder="Costo del producto"> 
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                <a class="btn btn-danger me-md-2" href="{{route ('Productos')}}" type="button">Regresar</a>
                <button class="btn btn-primary" type="summt">Guardar</button>
            </div>
        </form>

    </div>

    <script type='text/javascript'>
        $(document).ready(function (){
            jQuery("#nombre").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,.,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú,0-9]+$/g, ''));
            });
            jQuery("#descripcion").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^a-z,A-Z, ,.,´,á,é,í,ó,ú,Á,É,Í,Ó,Ú,0-9]+$/g, ''));
            });
            jQuery("#cantidad").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^0-9]+$/g, ''));
            });
            jQuery("#costo").on('input', function () {
                jQuery(this).val(jQuery(this).val().replace(/[^\d*\.?\d{0,2}]+$/g, ''));
            });

            $('#foto').on('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagen-seleccionada').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

        })
    </script>
</body>
</html>

@endif

@stop
