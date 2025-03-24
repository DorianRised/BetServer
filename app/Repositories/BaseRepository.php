<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as EloquentBaseRepository;

class BaseRepository extends EloquentBaseRepository
{
    /**
     * El modelo que este repositorio manejará.
     * Este método debe ser implementado por cada repositorio.
     */
    public function model()
    {
        // Este es solo un ejemplo genérico.
        // No debería usarse en una clase BaseRepository real.
        // Los repositorios específicos implementarán este método.
    }
}
