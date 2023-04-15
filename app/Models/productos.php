<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class productos extends Model
{
    use HasFactory;
    // use Softdeletes;
    protected $primaryKey = 'id_producto';
    protected $fillable= ['id_provedores', 'id_categoria', 'nombre_producto', 'descripcion', 'cantidad', 
    'costo','foto'];
}


