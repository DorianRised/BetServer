<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public $table = 'eventos';

    public $fillable = [
        'nombre',
        'liga_id',
        'deporte_id',
        'fecha'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static array $rules = [
        'nombre' => 'required',
        'liga_id' => 'required',
        'deporte_id' => 'required',
        'fecha' => 'required'
    ];

    
    public function liga()
    {
        return $this->belongsTo(Liga::class);
    }

    public function deporte()
    {
        return $this->belongsTo(Deporte::class);
    }
}
