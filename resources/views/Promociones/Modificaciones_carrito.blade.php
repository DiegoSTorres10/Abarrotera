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

    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/fixedHeader.dataTables.min.css')}}">
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.fixedHeader.min.js')}}"></script>

    <title> Modificación de promoción</title>

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


    @section('content')

    <main>
        <div class="container">

            <h1 class="text-center titulos"> Modificación de la promoción </h1>
            <form action="" method="" class="bg-fluid pb-3" enctype="multipart/form-data" autocomplete=off id="Foma" >
                <div class="mb-3">
                    <label class="mt-3 mb-2 letraLabel" for="producto">Seleccione el producto:<span>*</span></label>
                    <select required name="producto" id="producto">
                        @foreach ($seleccionProducto as $pro)
                            <option value="{{$pro->id_producto}}" selected>{{$pro->nombre_producto}} </option>
                            <input type="text" name="id_promocion" id="id_promocion" hidden value="{{$pro->id_promocion}}">
                        @endforeach
                    </select>
                    <div id= "ErrorProducto" class="alert alert-success font-italic d-none" role="alert"> Este producto ya tiene un descuento vigente, verifique el producto 
                    </div>
                    
                    <div id="DetallesProducto" class="container">

                    </div>

                    <div>
                        <label class="mt-3 mb-2  letraLabel" for="existencia">Existencia</label>
                        <input disabled type="radio" class="mx-1" name="existencia" id="Si">Si
                        <input disabled type="radio" class="mx-1" name="existencia" id="No">No
                    </div>

                    <div>
                        <label class="mt-3 mb-2  letraLabel" for="operacion">Seleccione la operación <span>*</span></label><br>
                        <input disabled type="radio" class="mx-3" name="operacion" id="Descuento">Reajustar descuento <br>
                        <input disabled type="radio" class="mx-3" name="operacion" id="Eliminardescuento">Eliminar descuento
                    </div>

                    <div id="Descu" class="d-none">
                    @foreach ($seleccionProducto as $pro)
                    
                        <label class="mt-3 mb-2  letraLabel" for="porcentaje_aumento">Introduzca el nuevo porcentaje: <span>*</span></label>
                        <input required  class="text-dark form-control" value="{{$pro->porcentaje_aumento}}" type="text" name="porcentaje_aumento" id="porcentaje_aumento" placeholder="El porcentaje debe ser 0.1-90.00" min="0"> 

                        
                        <label class="mt-3 mb-2  letraLabel" for="precio_antiguo">Precio antes de la rebaja:</label>
                        <input required  class="text-dark form-control" type="text" value="{{$pro->precio_antiguo}}" name="precio_antiguo" id="precio_antiguo" readonly> 
                        

                        <label class="mt-3 mb-2  letraLabel" for="precio">Precio con el nuevo descuento: </label>
                        <input readonly  class="text-dark form-control" type="text" name="precio" id="precio"> 

                        <label class="mt-3 mb-2  letraLabel" for="fechaVen">Fecha de vencimiento:<span>*</span> </label>
                        <input required  class="text-dark form-control"  type="date" name="fechaVen" id="fechaVen"> 

                        @endforeach
                    </div>

                    <div id="EliminarDescu" class="d-none">
                    
                    @foreach ($seleccionProducto as $pro)
                        <label class="mt-3 mb-2  letraLabel" for="porcentajeDes">Porcentaje de descuento</label>
                        <input required  class="text-dark form-control" value="{{$pro->porcentaje_aumento}}" type="text" name="porcentajeDes" id="porcentajeDes" readonly> 

                        <label class="mt-3 mb-2  letraLabel" for="precio_antiguo">Precio sin el descuento: </label>
                        <input readonly  class="text-dark form-control" value="{{$pro->precio_antiguo}}" type="text" name="precio_antiguo" id="precio_antiguo"> 

                    @endforeach
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3 mb-3">
                        <a class="btn btn-danger me-md-2" href="{{route ('ReportePromociones')}}" type="button">Regresar</a>
                        <input type="button" value="Reajustar porcentaje"  class="btn btn-primary d-none" id='AgregarDes' name='AgregarDes' disabled>
                        <input type="button" value="Eliminar porcentaje"  class="btn btn-primary d-none" id='eliminarDes' name='eliminarDes'>
                    </div>
                    <!-- Carrito de los descuentos -->
                    <div id="Carrito_descuentos">

                    </div>
                </div>
            </form>

        </div>
    </main>


    <script type="text/javascript">
    $(document).ready(function() {




        $("#DetallesProducto").load('{{url('DetallesProducto')}}' + '?id_producto='  + $("#producto").val()) ;


            //Para dejar en blanco y regresar los atributos cuando se colocan otro producto
            $("#Descu").addClass('d-none');
            $('#porcentaje_aumento').val('')
            $('#fechaVen').val('')
            $('#precio').val('')
            $('#Descuento').prop('checked', false);
            
            // Aqui solicito por medio de get la informacion solicitada por medio de una funcion llamada productos, para imprimir el valor recibido seria productos.existencias
            // existencias es asi porque en el controller coloque ese nombre
            $.get('{{url('ExistenciasProducto')}}' + '?id_producto=' + $("#producto").val(), function(productos) {
                if (productos.existencias > 0) {
                    $('#Si').prop('checked', true);
                    $('#Si').removeAttr('disabled');
                    $('#No').prop('checked', false);
                    $('#No').attr('disabled', true);

                    $('#Descuento').removeAttr('disabled');
                    $('#Eliminardescuento').removeAttr('disabled');
                    $('#Eliminardescuento').prop('checked', false);

                }else{
                    $('#Si').prop('checked', false);
                    $('#Si').attr('disabled', true);
                    $('#No').prop('checked', true);
                    $('#No').removeAttr('disabled');
                    
                    $('#Descuento').prop('checked', false);
                    $('#Descuento').attr('disabled', true);
                }
            });


        $("#Descuento").click(function (){
            $("#Descu").removeClass('d-none')
            $("#EliminarDescu").addClass('d-none')
            $("#AgregarDes").removeClass('d-none')
            $("#eliminarDes").addClass('d-none')

            
        });
        $("#Eliminardescuento").click(function (){
            $("#EliminarDescu").removeClass('d-none')
            $("#Descu").addClass('d-none')
            $("#eliminarDes").removeClass('d-none')
            $("#AgregarDes").addClass('d-none')
        });


        var porcentajevalidar, fechavalidar;
        // El evento blur nos servirá para cuando se pase a otra parte del formulario se valide, si es correcto se
        //se dejara, si introduce 3 decimale lo redondiara a 2 y si no es correcto lo eliminará
        $("#porcentaje_aumento").on('blur', function () {
            var min = 0.1;
            var max = 99.0;
            var val = parseFloat($(this).val().replace(/[^\d*\.?\d{0,2}]+$/g, ''));
            if (!isNaN(val) && val >= min && val <= max) {
                jQuery(this).val(val.toFixed(2));

                porcentajevalidar = $("#porcentaje_aumento").val();
                fechavalidar = $('#fechaVen').val();
                
                if (fechavalidar!='' && porcentajevalidar!= ''){
                    $("#AgregarDes").removeAttr('disabled')
                }else{
                    $("#AgregarDes").attr('disabled', true);
                }

                let porcentaje  = parseFloat($('#porcentaje_aumento').val()); 
                let descuentoPor = $("#precio_antiguo").val()-($("#precio_antiguo").val()*porcentaje/100);
                $('#precio').val(descuentoPor.toFixed(2))

            } else {
                $("#AgregarDes").attr('disabled', true);
                $(this).val('');
                $('#precio').val('')
            }
        });

        //Para el miniimo de las fecha para las promociones de vigencia
        var hoy = new Date();
        var fecha_formateada = hoy.toISOString().split('T')[0];
        $('#fechaVen').attr('min', fecha_formateada);

        // Evento change del campo #fechaVen
        $('#fechaVen').on('change', function () {
            porcentajevalidar = $("#porcentaje_aumento").val();
            fechavalidar = $('#fechaVen').val();
            
            if (fechavalidar!='' && porcentajevalidar!= ''){
                $("#AgregarDes").removeAttr('disabled')
            }else{+
                $("#AgregarDes").attr('disabled', true);
            }
        });


        $("#AgregarDes").click(function() {
            $("#Carrito_descuentos").load('{{url('Carrito_descuentos_reajuste')}}' + '?' + $(this).closest('form').serialize()) ;
        
            //Para dejar en blanco y regresar los atributos cuando se colocan otro producto
            $("#Descu").addClass('d-none');
            $('#porcentaje_aumento').val('')
            $('#fechaVen').val('')
            $('#precio').val('')
            $('#Descuento').prop('checked', false); 
            $("#AgregarDes").attr('disabled', true);
            $("#Eliminardescuento").attr('disabled', true);
            $('#Descuento').attr('disabled', true);
            $("#AgregarDes").addClass('d-none');
            

        });

        $("#eliminarDes").click(function() {
            $("#Carrito_descuentos").load('{{url('borrardescuentos')}}' + '?' + $(this).closest('form').serialize()) ;
        
            //Para dejar en blanco y regresar los atributos cuando se colocan otro producto
            $("#Descu").addClass('d-none');
            $('#porcentaje_aumento').val('')
            $('#fechaVen').val('')
            $('#precio').val('')
            $('#Descuento').prop('checked', false); 
            $("#AgregarDes").attr('disabled', true);
            $("#Eliminardescuento").attr('disabled', true);
            $('#Descuento').attr('disabled', true);
            $("#eliminarDes").addClass('d-none');
        });



    });
    </script>
</body>
</html>

@endif


@stop
