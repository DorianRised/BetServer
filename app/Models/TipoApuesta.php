<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoApuesta extends Model
{
    public $table = 'tipo_apuestas';

    public $fillable = [
        'nombre',
        'descripcion',
        'codigo',
        'activo',    
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static array $rules = [
        'nombre' => 'required'
    ];

    
}
