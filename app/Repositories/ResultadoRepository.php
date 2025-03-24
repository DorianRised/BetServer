<?php

namespace App\Repositories;

use App\Models\Resultado;
use App\Repositories\BaseRepository;

class ResultadoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Resultado::class;
    }
}
