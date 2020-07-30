<?php

namespace Cotacao\Repositories;

use Cotacao\Models\Bloco;

class BlocoRepository
{
    private Bloco $blocoMode;

    public function __construct(
        Bloco $blocoMode
    )
    {
        $this->blocoMode = $blocoMode;

    }
}