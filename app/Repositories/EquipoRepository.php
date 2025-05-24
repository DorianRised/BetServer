<?php

namespace App\Repositories;

use App\Models\Equipo;
use App\Repositories\BaseRepository;

class EquipoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nombre',
        'deporte_id',
        'cagegoria'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Equipo::class;
    }
}
