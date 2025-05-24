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
        'fecha', 
        'equipo_visitante_id',
        'equipo_local_id',
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

    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }
    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }
    public function liga()
    {
        return $this->belongsTo(Liga::class);
    }

    public function deporte()
    {
        return $this->belongsTo(Deporte::class);
    }
}
