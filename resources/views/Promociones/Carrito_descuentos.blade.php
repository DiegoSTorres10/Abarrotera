<div class="table-responsive bg-light mt-4 ">
  <table class="tablaHijos text-center display" style="width:100%"  id="example" >
        <thead class="btn-teal nav-bg text-black">
            <tr>
                <th scope="col">Clave del producto</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio Antiguo</th>
                <th scope="col">Porcentaje de descuento</th>
                <th scope="col">Precio actual</th>
                <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($consulta as $pro)
            <tr class="table-active">
                
                <td> {{$pro-> id_producto}}</td>
                <td> {{$pro->nombre_producto }}</td>
                <td> {{$pro->precio_antiguo }}</td>
                <td> {{$pro->porcentaje_aumento }}</td>
                <td> {{$pro->costo }}</td>
                <td>
                    <?php
                    $fecha_finalizacion = $pro->fecha_finalizacion;
                    $hoy = date("Y-m-d"); 
                    if ($fecha_finalizacion < $hoy) {
                        echo "No se puede eliminar, ya que se encuentra no activa la promoción";
                    } else { 
                        echo "<form action='' method = 'POST' enctype='application/x-www-form-urlencoded'   
                        name='frmdo{$pro->id_promocion}' id='frmdo{$pro->id_promocion}' target='_self'>
                            <input type='hidden' value='{$pro->id_promocion}' name='id_promocion' id='id_promocion'>
                            <input type='hidden' value='{$pro->id_producto}' name='id_producto' id='id_producto'>
                            <input type='hidden' value='{$pro->porcentaje_aumento}' name='porcentaje_aumento' id='porcentaje_aumento'>
                            <input type='button' id='BorrarDescuentos' name='BorrarDescuentos' class='borrar' value='Borrar' />
                            <input type='button' id='EditarDescuentos' name='EditarDescuentos' class='editar' value='Editar' />
                        </form>";
                    }
                    ?>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(function () {
  $('.borrar').click(
    function () {
      formulario = this.form;
      $("#Carrito_descuentos").load('{{url('borrardescuentos')}}' + '?' + $(this).closest('form').serialize()) ;
    }
  );
});

$(function () {
  $('.editar').click(function () {
      formulario = this.form;
      window.location.href = '{{url('Editar_promocion_carrito')}}?id_promocion=' + formulario.id_promocion.value;
  });
});

$('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
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
</script>