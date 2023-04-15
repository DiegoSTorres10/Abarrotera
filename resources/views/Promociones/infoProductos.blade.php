

<h2 class="font-weight-bold text-center font-italic">Datos del producto</h2>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label mt-1" for="id">Id producto</label>
            <input readonly class="text-dark form-control" type="text" name="id" id="id" value="{{$productos->id_producto}}"> 
        </div>
        <div class="mb-3">
            <label class="form-label mt-3" for="nombre">Nombre del producto</label>
            <input readonly  class="text-dark form-control" value="{{$productos->nombre_producto}}" type="text" name="nombre" id="nombre" placeholder="Nombre del producto"> 
        </div>
        <div class="mb-3">
            <label class="form-label mt-3" for="descripcion">Descripción</label>
            <input readonly  class="text-dark form-control" value="{{$productos->descripcion}}" type="text" name="descripcion" id="descripcion" placeholder="Descripcion del producto"> 
        </div>
        <div class="mb-3">
            <label class="form-label mt-3" for="foto">Foto del producto</label> <br>
            <img readonly id="imagen-seleccionada" src="{{asset('archivos/'.$productos->foto)}}" class="img" alt="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label mt-1" for="proveedor">Proveedor</label>
            <select readonly name="proveedor" id="proveedor">
                @foreach ($proveedores as $pro)
                    @if ($pro->id_provedores == $productos->id_provedores)
                        <option selected disabled value="{{$pro->id_provedores}}" selected>{{$pro->nombre_empresa}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
        <label class="form-label mt-1" for="categoria">Categoria*</label>
            <select readonly name="categoria" id="categoria">
                @foreach ($categorias as $ca)
                    @if ($ca->id_categoria == $productos->id_categoria)
                        <option selected disabled value="{{$ca->id_categoria}}" selected>{{$ca->nombre_categoria}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label mt-3" for="cantidad">Cantidad en existencia</label>
            <input readonly  class="text-dark form-control" value="{{$productos->cantidad}}" type="number" name="cantidad" id="cantidad" min="1" placeholder="Cantidad del producto"> 
        </div>
        <div class="mb-3">
            <label class="form-label mt-3" for="costo">Precio</label>
            <input readonly  class="text-dark form-control" value="{{$productos->costo}}" type="text" min="0" step="0.01" name="costo" id="costo" placeholder="Costo del producto"> 
        </div>
    </div>
</div>