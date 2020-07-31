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

    public function buscaPorCodigoMunicipio(string $codigo)
    {
        return $this->model->where('CODMUN_CID', '=', $codigo)->get();
    }

}