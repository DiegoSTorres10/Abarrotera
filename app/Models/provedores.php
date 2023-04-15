<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class provedores extends Model
{
    use HasFactory;
    // use Softdeletes;
    protected $primaryKey = 'id_provedores';
    protected $fillable= ['nombre_empresa'];
}
