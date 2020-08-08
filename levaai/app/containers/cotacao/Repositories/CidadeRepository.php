<?php

namespace Cotacao\Repositories;

use Cotacao\Models\Cidade;
use Ship\Base\Repository\EloquentRepository;

class CidadeRepository extends EloquentRepository
{
    protected $model;

    public function __construct(Cidade $model)
    {
        $this->model = $model;
    }

    /**
     * Busca cidade pelo código do municipio
     *
     * @param string $codigo
     * @return Cidade|null
     */
    public function buscaPorCodigoMunicipio(string $codigo): ?Cidade
    {
        return $this->model->where('CODMUN_CID', '=', $codigo)->first();
    }

}