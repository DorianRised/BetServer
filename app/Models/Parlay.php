<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parlay extends Model
{
    public $table = 'parlays';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static array $rules = [
        'nombre' => 'required'
    ];

    
}
