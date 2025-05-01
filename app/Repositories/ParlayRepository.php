<?php

namespace App\Repositories;

use App\Models\Parlay;
use App\Repositories\BaseRepository;

class ParlayRepository extends BaseRepository
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
        return Parlay::class;
    }
}
