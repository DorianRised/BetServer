<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parlay extends Model
{
    public $table = 'parlays';

    public $fillable = [
        'nombre', 
        'user_id',
        'tipster_id',
        'fecha',
        'monto',
        'ganancia_potencial',
        'estado'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static array $rules = [
        'nombre' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tipster()
    {
        return $this->belongsTo(Tipster::class);
    }
    public function apuestas()
    {
        return $this->belongsToMany(Apuesta::class, 'parlay_apuestas');
    }
}
