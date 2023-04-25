
@section('content')
<div class="container">

    
    <h1 class="text-center titulos"> Promociones </h1>

        <a type="button"  href="{{ route('NuevaPromocion')}}" class="btn btn-success">Nueva Promoción</a>

        <div class="table-responsive bg-light mt-4 mb-5 ">
            <table class="tablaHijos text-center display" style="width:100%"  id="tabla_promociones" >
                <thead class="btn-teal nav-bg text-black">
                    <tr>
                        
                        <th scope="col">Clave del producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Porcentaje de aumento</th>
                        <th scope="col">Costo Antiguo</th>
                        <th scope="col">Costo Actual</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($promociones as $pro)
                    <tr class="table-active">
                        
                        <td> {{$pro-> id_producto}}</td>
                        <td> {{$pro->nombre_producto }}</td>
                        <td> {{$pro->nombre_empresa }}</td>
                        <td> {{$pro->porcentaje_aumento }}</td>
                        <td> {{$pro->precio_antiguo }}</td>
                        <td> {{$pro->costo }}</td>
                        <td> {{$pro->fecha_finalizacion }}</td>
                        <td class="{{ $pro->estatus == 1 ? 'vigente' : 'no-vigente' }}">
                            @if ($pro->estatus==1)
                                Vigente
                            @else
                                No vigente
                            @endif
                        </td>
                        <td>
                            @if ($pro->estatus==1)
                            <a class="badge rounded-pill bg-info" href="{{route('Editar_promocion',['id_promocion'=> $pro->id_promocion])}}">Modificar</a> 
                            @else
                                No vigente, por lo tanto no puedes modificarla, crea una nueva promoción del producto
                            @endif
                           
                        </td>
                      
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop 

@section('css')
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/fixedHeader.dataTables.min.css')}}">
@endsection

@section('js')
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.fixedHeader.min.js')}}"></script>
    <script>
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tabla_promociones thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tabla_promociones thead');
 
    var table = $('#tabla_promociones').DataTable({
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
@endsection
    