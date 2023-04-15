<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ventas extends Model
{
    use Softdeletes;
    // use HasFactory;
    protected $primaryKey = 'id_venta';
    protected $fillable= ['id_vendedor', 'id_cliente', 'fecha', 'monto_pagar'];
}
