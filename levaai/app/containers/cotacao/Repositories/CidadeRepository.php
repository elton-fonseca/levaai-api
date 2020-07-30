<?php

namespace Cotacao\Repositories;

use Cotacao\Models\Cidade;


class CidadeRepository
{
    private Cidade $cidadeMode;


    public function __construct(
        Cidade $cidadeMode
    )
    {
        $this->cidadeMode = $cidadeMode;

    }
}