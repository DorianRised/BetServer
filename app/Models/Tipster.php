<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipster extends Model
{
    public $table = 'tipsters';

    public $fillable = [
        'nombre',
        'apellidos',
        'email',
        'fecha_registro',
        'fecha_nacimiento',
        'bank_inicial',
        'bank_actual',
        'roi', 
        'user_id',
        'grupo_id',
        'pais',
    ];
    
    protected $dates = ['fecha_registro', 'created_at', 'updated_at'];

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
    public function apuestas()
    {
        return $this->hasMany(Apuesta::class);
    }
}
