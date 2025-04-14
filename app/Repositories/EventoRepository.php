<?php

namespace App\Repositories;

use App\Models\Evento;
use App\Repositories\BaseRepository;

class EventoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nombre',
        'liga_id',
        'deporte_id',
        'fecha'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Evento::class;
    }
}
