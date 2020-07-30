<?php

namespace Cotacao\Tasks;

use Cotacao\Repositories\BlocoRepository;
use Cotacao\Repositories\CidadeRepository;

class BuscaBlocos
{
    private BlocoRepository $blocoRepository;

    private CidadeRepository $cidadeRepository;

    public function __construct(
        BlocoRepository $blocoRepository,
        CidadeRepository $cidadeRepository
    )
    {
        $this->blocoRepository = $blocoRepository;
        $this->cidadeRepository = $cidadeRepository;
    }

    public function executar()
    {
        $cidade = $this->cidadeRepository->buscaPorCodigoMunicipio(123);

        dd($cidade);

        echo "buscarBloco";
    }
}