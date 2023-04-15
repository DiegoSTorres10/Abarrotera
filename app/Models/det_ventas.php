<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class det_ventas extends Model
{
    use HasFactory;
    // use Softdeletes;
    protected $primaryKey = 'id_detventas';
    protected $fillable= ['id_venta', 'id_producto', 'cantidad', 'costo'];
}

