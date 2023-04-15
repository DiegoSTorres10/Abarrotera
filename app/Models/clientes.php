<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class clientes extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cliente';
    protected $fillable= ['nombre', 'apellido_p', 'apellido_m', 'fecha_nacmiento', 
    'sexo'];
    // use Softdeletes;
}
