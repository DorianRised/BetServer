<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public $table = 'equipos';

    public $fillable = [
        'nombre',
        'deporte_id',
        'cagegoria', 
        'pais',
        'logo', 
    ];

    protected $casts = [
        'nombre' => 'string',
        'cagegoria' => 'string', 
        'deporte_id' => 'integer',
        'pais' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:100|unique:equipos',
        'deporte_id' => 'required|exists:deportes,id',
        'categoria' => 'required|string|max:50',
        'pais' => 'required|string|max:50',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    public function eventosVisitante()
    {
        return $this->hasMany(Evento::class, 'equipo_visitante_id');
    }
    public function eventosLocal()
    {
        return $this->hasMany(Evento::class, 'equipo_local_id');
    }
    public function deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id');
    }
    
}
