<?php

namespace App\Repositories;

use App\Models\Apuesta;
use App\Repositories\BaseRepository;

class ApuestaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Apuesta::class;
    }
}
