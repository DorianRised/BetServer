<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public $table = 'grupos';

    public $fillable = [
        'nombre', 
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    public function tipsters()
    {
        return $this->hasMany(Tipster::class);
    }
    
}
