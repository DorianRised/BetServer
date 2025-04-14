<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Deporte extends Model
{
    public $table = 'deportes';

    public $fillable = ['nombre', 'img_deporte'];

    // Accesor para la URL completa de la imagen
    public function imagenUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->img_deporte ? Storage::url($this->img_deporte) : null,
        );
    }

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    
}
