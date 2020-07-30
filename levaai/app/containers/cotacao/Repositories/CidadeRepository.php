<?php

namespace Cotacao\Repositories;

use Cotacao\Models\Cidade;
use Ship\Base\Repository\EloquentRepository;

class CidadeRepository extends EloquentRepository
{
    protected $model;

    public function __construct(
        Cidade $model
    )
    {
        $this->model = $model;
    }

    public function buscaPorCodigoMunicipio(int $codigo = 4200408)
    {
        return $this->model->get();
    }

}