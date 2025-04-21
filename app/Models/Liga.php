<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use App\Models\Evento;
use App\Models\Deporte;

class Liga extends Model
{
    public $table = 'ligas';

    public $fillable = [
        'nombre', 'pais', 'img_liga', 'deporte_id', 
    ];

    public function imagenUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->img_liga ? Storage::url($this->img_liga) : null,
        );
    }

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function deporte()
    {
        return $this->belongsTo(Deporte::class);
    }
}
