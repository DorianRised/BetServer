<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apuesta extends Model
{
    public $table = 'apuestas';

    public $fillable = [
        'deporte_id',
        'liga_id',
        'evento_id',
        'fecha_evento',
        'grupo_id',
        'tipster_id',
        'tipo',
        'apuesta',
        'tipo_apuesta_id',
        'monto',
        'cuota',
        'ganancia_total',
        'parlay_id',
        'resultado',
        'user_id',
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    public function parlays()
    {
        return $this->belongsToMany(Parlay::class, 'parlay_apuestas')
                    ->withPivot('cuota', 'resultado')
                    ->withTimestamps();
    }
    
}
