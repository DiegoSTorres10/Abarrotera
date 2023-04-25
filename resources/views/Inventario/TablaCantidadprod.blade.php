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

    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/fixedHeader.dataTables.min.css')}}">
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.fixedHeader.minjs')}}"></script>



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

    
    <h1 class="text-center titulos"> Promociones </h1>

        <a type="button"  href="{{ route('NuevaPromocion')}}" class="btn btn-success">Agregar producto</a>

        <div class="table-responsive bg-light mt-4 mb-5 ">
            <table class="tablaHijos text-center display" style="width:100%"  id="example" >
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
<script>
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        //Para ordenar la pagina 
        order: [[7, 'desc']],
    orderCellsTop: true,
    fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
</script>


</body>
</html>

@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop