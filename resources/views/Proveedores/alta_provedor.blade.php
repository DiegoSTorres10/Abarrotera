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

    <title>Alta proveedor</title>
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
    <nav class="navbar">
        <div class="containerlogo">
            <a href="#" class="logo">Abarrotes Huachi</a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('Productos')}}">Productos</a></li>
            <li><a href="{{ route('Categorias')}}">Categorias</a></li>
            <li><a href="{{ route('Vendedor')}}">Vendedores</a></li>
            <li><a href="{{ route('Proveedores')}}">Proveedores</a></li>     
            <li><a href="{{ route('CerrarSesion')}}">Cerrar Sesión</a></li>  
        </ul>
    </nav>

    <div class="container">
        <h1 class="text-center"> Alta de proveedores</h1>
        <hr>

        <form action="{{route('proceso_proveedor')}}" method="POST" class="bg-fluid pb-3" autocomplete=off>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label mt-3" for="nombre">Nombre de la empresa<span>*</span></label>
                        <input required  class="text-dark form-control" type="text" name="nombre" id="nombre" placeholder="Nombre de la categoria"> 
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                        <a class="btn btn-danger me-md-2" href="{{route ('Proveedores')}}" type="button">Regresar</a>
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
        })
    </script>
</body>
</html>
@endif