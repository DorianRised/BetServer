<?php

namespace App\Repositories;

use App\Models\TipoApuesta;
use App\Repositories\BaseRepository;

class TipoApuestaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nombre'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return TipoApuesta::class;
    }
}
