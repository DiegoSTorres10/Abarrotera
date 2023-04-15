<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class vendedores extends Model
{
    use HasFactory;
    // use Softdeletes;
    protected $primaryKey = 'id_vendedor';
    protected $fillable= ['nombre', 'apellido_p', 'apellido_m', 'domicilio', 
    'ciudad','id_estado', 'curp', 'fecha_nacimiento', 'sexo'];
}
