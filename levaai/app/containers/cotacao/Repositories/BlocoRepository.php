<?php

namespace Cotacao\Repositories;

use Cotacao\Models\Bloco;
use Ship\Base\Repository\EloquentRepository;

class BlocoRepository extends EloquentRepository
{
    protected $model;

    public function __construct(
        Bloco $model
    )
    {
        $this->model = $model;
    }
}