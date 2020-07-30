<?php

namespace Cotacao\Tasks;

use Cotacao\Repositories\BlocoRepository;


class BuscaBlocos
{
    private BlocoRepository $blocoRepositoryRepositories;


    public function __construct(
        BlocoRepository $blocoRepositoryRepositories
    )
    {
        $this->blocoRepositoryRepositories = $blocoRepositoryRepositories;

    }
}