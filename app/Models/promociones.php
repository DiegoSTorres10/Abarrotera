<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promociones extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_promocion';
    protected $fillable= ['id_producto', 'porcentaje_aumento', 'precio_antiguo', 'fecha_finalizacion', 'estatus'];
}
