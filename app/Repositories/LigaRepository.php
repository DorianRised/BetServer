<?php

namespace App\Repositories;

use App\Models\Liga;
use App\Repositories\BaseRepository;

class LigaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Liga::class;
    }
}
