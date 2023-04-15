<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\promociones;
use App\Models\productos;


class ActualizarPromociones extends Command
{
    protected $signature = 'promociones:actualizar';

    protected $description = 'Actualiza el estatus y precio de las promociones caducadas';

    public function handle()
    {
        $promociones = promociones::where('estatus', 1)
            ->where('fecha_finalizacion', '<', now())
            ->get();

        foreach ($promociones as $promocion) {
            $producto = productos::find($promocion->id_producto);
            $CostoDeLaRebajaCaducar = $producto->costo;
            $producto->costo = $promocion->precio_antiguo;
            $promocion->precio_antiguo = $CostoDeLaRebajaCaducar;
            $producto->save();
            $promocion->estatus = 0;
            $promocion->save();
        }

        $this->info('Las promociones han sido actualizadas correctamente');
    }
}
