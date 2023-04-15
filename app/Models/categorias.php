<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class categorias extends Model
{
    use HasFactory;
    // use Softdeletes;
    protected $primaryKey = 'id_categoria';
    protected $fillable= ['nombre_categoria'];
}
