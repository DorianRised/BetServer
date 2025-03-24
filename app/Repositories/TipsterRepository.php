<?php

namespace App\Repositories;

use App\Models\Tipster;
use App\Repositories\BaseRepository;

class TipsterRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Tipster::class;
    }
}
