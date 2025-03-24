<?php

namespace App\Repositories;

use App\Models\Deporte;
use App\Repositories\BaseRepository;

class DeporteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Deporte::class;
    }
}
